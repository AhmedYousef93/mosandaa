<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\ServiceWithSubServiceResource;
use App\Http\Resources\SubServiceResource;
use App\Models\Service;
use App\Models\Subservice;
use App\Traits\ResponseTrait;

class ServiceController extends Controller
{
    use ResponseTrait;


    public function index()
    {
        $services = Service::get();
        return self::successResponse(data: ServiceResource::collection($services));
    }
    public function allServiceWithSubServices()
    {
        $services = Service::with('subservices')->get();
        return self::successResponse(data: ServiceResource::collection($services));
    }

    public function getSubService($service)
    {
        $subService = Subservice::where('service_id', $service)->get();
        return self::successResponse(data: SubServiceResource::collection($subService));

    }
}