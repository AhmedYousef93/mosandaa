<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AreaResource;
use App\Http\Resources\CityResource;
use App\Http\Resources\StateResource;
use App\Models\Area;
use App\Models\City;
use App\Models\State;
use App\Traits\HasAttachment;
use App\Traits\ResponseTrait;

class SettingController extends Controller
{
    use ResponseTrait,HasAttachment;

   
    public function cities(): \Illuminate\Http\JsonResponse
    {
        $cities = City::paginate();
        return self::successResponse(data:CityResource::collection($cities)->response()->getData(true));
    }
    public function states($id): \Illuminate\Http\JsonResponse
    {
        $states = State::where('area_id',$id)->paginate();
        return self::successResponse(data:StateResource::collection($states)->response()->getData(true));
    }

    public function areas($id): \Illuminate\Http\JsonResponse
    {
        $states = Area::where('city_id',$id)->paginate();
        return self::successResponse(data:AreaResource::collection($states)->response()->getData(true));
    }
}
