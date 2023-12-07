<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\AddressResource;
use App\Http\Resources\TimeResource;
use App\Models\Day;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class TimeController extends Controller
{
    use ResponseTrait;

    public function getTimes($date)
    {
        $dayName = Carbon::parse($date)->format('l');
        $day = Day::whereName($dayName)->first();
        return self::successResponse(__('application.address'), TimeResource::collection($day->times));

    }

}