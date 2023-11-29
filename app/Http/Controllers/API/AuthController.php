<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\LoginUserResquest;
use App\Http\Requests\API\RegisterRequest;
use App\Http\Requests\API\ResetCodeResquest;
use App\Http\Requests\API\UpdatePasswordRequest;
use App\Http\Requests\Api\UpdateUserProofileRequest;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Http\Requests\Api\UserLoginRequest;
use App\Http\Requests\Api\UserRegisterRequest;
use App\Http\Requests\Api\UserResetPasswordRequest;
use App\Http\Requests\API\VerifyRequest;
use App\Http\Resources\UserShowResource;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserMail;
use App\Traits\ResponseTrait;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ResponseTrait;

    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    // user register
    public function register(UserRegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        $userData = $request->safe()->except(['password', 'fcm_token', 'id_number', 'date_of_birth']);
        $userData['password'] = bcrypt($request->password);
        $userData['code'] = generate_verification_code();
        $user = User::create($userData);
        $userDetails = $request->only(['id_number', 'date_of_birth']);
        $this->userService->storeUserDetails($userDetails, $user->id);
        $user->fcmTokens()->firstOrCreate(['fcm_token' => $request['fcm_token']]);
        $user->token = $user->createToken('PersonalAccessToken')->plainTextToken;
        return self::successResponse(__('application.mustverfiy'), UserResource::make($user));
    }

    public function verify(VerifyRequest $request)
    {
        $user = User::find($request->id);

        if ($user->code != $request->code) {
            return self::failResponse(422, __('application.wrongcode'));
        }

        $user->update(['verified' => 1]);
        // $user->tokens()->delete();
        return self::successResponse(__('application.verfied'), UserResource::make($user));
    }

    public function resetCode(ResetCodeResquest $request)
    {
        $user = User::where('email', $request->email)->first();
        $user->update(['code' => mt_rand(1000, 9999)]);

        //   $userMailData = [
        //         'title' => 'تفعيل الحساب الخاص بك',
        //         'body'  =>  'يرجى تفعيل الحساب الخاص بك عن طريق كتابه الكود الخاص بك فى حقل الكود .. اذا واجهتكم اى مشاكل يرجى التواصل مع اداره التطبيق',
        //         'code'  => $user->code,
        //   ];

        //   Mail::to($user->email)->send(new UserMail($userMailData));
        return self::successResponse(__('application.resetcode'), UserResource::make($user));
    }
    // resend code
    public function resendCode(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = User::where('id', $request->id)->first();
        $user->update(['code' => generate_verification_code()]);
        return self::successResponse(__('application.resendcode'), UserResource::make($user));
    }

    //reset password
    public function resetPassword(UserResetPasswordRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = User::where('email', $request->email)->first();
        $user->update(['password' => bcrypt($request->password)]);
        return self::successResponse(__('application.passwordupdated'), UserResource::make($user));
    }


    // user login
    public function login(UserLoginRequest $request): \Illuminate\Http\JsonResponse
    {
        $credentials = $request->only(['phone', 'password']);

        if (!Auth::attempt($credentials)) {
            return self::failResponse(422, __('application.unauthorized'));
        }

        $user = $request->user();
        $user->fcmTokens()->firstOrCreate(['fcm_token' => $request['fcm_token']]);
        $user->token = $user->createToken('PersonalAccessToken')->plainTextToken;

        return match (true) {
            $user->verified == 0 => self::failResponse(420, __('application.notverfied')),
            $user->is_deleted == 1 => self::failResponse(422, __('application.unauthorized')),
            default => self::successResponse(__('application.loginsuccessfully'), UserResource::make($user)),
        };
    }

    //logout
    public function logout(Request $request)
    {
        auth('api')->user()->currentAccessToken()->delete();
        auth('api')->user()->fcmTokens()->whereFcmToken($request->fcm_token)->delete();
        return self::successResponse(__('application.loggedout'));
    }

    // update user
    public function update(UpdateUserRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = auth('api')->user();
        $user->update($request->safe()->toArray());
        return self::successResponse(__('application.updated'), UserResource::make($user));
    }

    public function updateProfile(UpdateUserProofileRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = auth('api')->user();
        $userDetails = $request->safe()->except('attachments');
        $this->userService->storeUserDetails($userDetails, $user->id);
        if ($request->attachments) {
            $user->assignAttachment($request->attachments);
        }
        return self::successResponse(__('application.updated'), UserResource::make($user));

    }

    public function show()
    {
        return self::successResponse(__('application.user'), UserShowResource::make(auth('api')->user()));
    }

}
