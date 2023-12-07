<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderRequestValidator;
use App\Http\Resources\OrderKidResource;
use App\Http\Resources\OrderResource;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends BaseController {
    use ResponseTrait;

    public function post(OrderRequestValidator $request) {

        DB::beginTransaction();
        try {

            $validatedData = $request->validated();

            $orderData = $request->except('researcher_name', 'researcher_title');
            $legalAdviceData = $request->only('researcher_name', 'researcher_title','time','date');

            
            $order = Order::create($orderData);

            $order->legalAdviceOrderDetail()->create($legalAdviceData);
            $order->orderTimeDate()->create($legalAdviceData);

            DB::commit();
            return self::successResponse(__('application.added'), OrderResource::make($order));
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
