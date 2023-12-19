<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OrderRequestValidator;
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

class OrderController extends BaseController
{
    use ResponseTrait;


    public function index(Request $request)
    {
        $newOrders = Order::newOrdersByUser(Auth::user()->id)->latest()->paginate(10);
        $doneOrders = Order::doneOrdersByUser(Auth::user()->id)->latest()->paginate(10);

        $data['current'] = OrderMinimumResource::collection($newOrders)->response()->getData(true);
        $data['previous'] = OrderMinimumResource::collection($doneOrders)->response()->getData(true);

        return self::successResponse(__('application.added'), $data);
    }
    public function store(OrderRequestValidator $request)
    {

        DB::transaction(function () use ($request) {
            $validatedData = $request->validated();
            $orderData = $request->except('researcher_name', 'researcher_title', 'type', 'case_language');
            $orderData['user_id'] = Auth::user()->id;
            $orderData['status'] = 1;
            $legalAdviceData = $request->only('researcher_name', 'researcher_title','case_language', 'type');
            // $orderTimeDate = $request->only('time', 'date');
            // $order->orderTimeDate()->create($orderTimeDate);
            $order = Order::create($orderData);
            $order->legalAdviceOrderDetail()->create($legalAdviceData);
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
