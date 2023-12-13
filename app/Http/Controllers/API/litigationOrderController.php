<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\litigationOrderRequest;
use App\Http\Resources\OrderKidResource;
use App\Http\Resources\OrderMinimumResource;
use App\Http\Resources\OrderResource;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class litigationOrderController extends BaseController
{
    use ResponseTrait;

    public function store(litigationOrderRequest $request)
    {
        DB::transaction(function () use ($request) {
            $validatedData = $request->validated();
            $orderData = $request->only('service_id', 'subservice_id');
            $orderData['user_id'] = Auth::user()->id;
            $orderData['status'] = 1;
            $litigationData = $request->only('title', 'description', 'owner_case', 'defendants_name', 'id_number_accused');
            $order = Order::create($orderData);
            $order->litigationOrderDetail()->create($litigationData);
            if ($request->attachments)
                $order->assignAttachment($request->attachments);

            return self::successResponse(__('application.added'));
        });
    }

    public function order($id)
    {
        $data = new OrderResource(Order::find($id));
        return self::successResponse('', $data);
    }

    public function order_kid($id)
    {
        $order = Order::find($id);
        $data = new OrderResource(Order::find($id));
        return self::successResponse('', $data);
    }
}
