<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Api\UpdateAddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use App\Services\AddressService;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    private $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    public function store(Request $request)
    {
        $address = $this->addressService->createAddress($request->safe()->toArray());

        return self::successResponse(__('application.address'), AddressResource::make($address));
    }

    public function show(Address $address)
    {
        return self::successResponse(__('application.address'), AddressResource::make($address));

    }

    public function addresses(): \Illuminate\Http\JsonResponse
    {
        return self::successResponse(data: AddressResource::collection(auth('api')->user()->addresses()->get()));
    }

    public function update(UpdateAddressRequest $request, Address $address): \Illuminate\Http\JsonResponse
    {

        $address = $this->addressService->updateAddress($address->id, $request->validated());
        return self::successResponse((string) __('application.updated'), AddressResource::make($address));
    }

    public function destroy(Address $address): \Illuminate\Http\JsonResponse
    {
        $this->addressService->deleteAddress($address->id);

        return self::successResponse(message: (string) __('application.deleted'));
    }


}