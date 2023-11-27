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
    use ResponseTrait, HasAttachment;


    public function cities(): \Illuminate\Http\JsonResponse
    {
        $cities = City::paginate();
        return self::successResponse(data: CityResource::collection($cities)->response()->getData(true));
    }

    public function states(Area $area): \Illuminate\Http\JsonResponse
    {
        $states = $area->states()->paginate();

        return self::successResponse(data: StateResource::collection($states)->response()->getData(true));
    }

    public function areas(City $city): \Illuminate\Http\JsonResponse
    {
        $areas = $city->areas()->paginate();
        return self::successResponse(data: AreaResource::collection($areas)->response()->getData(true));
    }
}
