<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OrderRequestValidator;
use App\Http\Resources\OrderKidResource;
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

class OrderController extends BaseController {
    use ResponseTrait;

    public function store(OrderRequestValidator $request) {

        DB::beginTransaction();
        try {

            $validatedData = $request->validated();

            $orderData = $request->except('researcher_name', 'researcher_title','type','case_language');
            $orderData['user_id'] = Auth::user()->id;
            $orderData['status'] = 1;
            $legalAdviceData = $request->only('researcher_name', 'researcher_title', 'time_id', 'date', 'case_language', 'type');
            $orderTimeDate = $request->only('time_id', 'date');


            $order = Order::create($orderData);

            $order->legalAdviceOrderDetail()->create($legalAdviceData);
            $order->orderTimeDate()->create($orderTimeDate);
            if($request->file)
                auth()->user()->assignAttachment($request->file);
            if($request->recordes)
                auth()->user()->assignAttachment($request->file);

            DB::commit();
            return self::successResponse(__('application.added'));
        } catch (\Exception $e) {
            return $e;
            DB::rollback();
            // something went wrong
        }
    }

    public function order($id) {
        $data = new OrderResource(Order::find($id));
        return self::successResponse('', $data);
    }

    public function order_kid($id) {
        $order = Order::find($id);
        $data = new OrderResource(Order::find($id));
        return self::successResponse('', $data);
    }
}
