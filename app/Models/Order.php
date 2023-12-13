<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\OrderStatusEnum;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'status' => OrderStatusEnum::class,
    ];

    public function scopeNewOrdersByUser($query, $userId)
    {
        return $query->where('user_id', $userId)
            ->whereIn('status', [
                OrderStatusEnum::new ,
                OrderStatusEnum::pending,
                OrderStatusEnum::lake_of_documents
            ]);
    }

    public function scopeDoneOrdersByUser($query, $userId)
    {
        return $query->where('user_id', $userId)
            ->where('status', OrderStatusEnum::done);
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function subservice()
    {
        return $this->belongsTo(Subservice::class);
    }

    public function legalAdviceOrderDetail()
    {
        return $this->hasOne(LegalAdviceOrderDetail::class);
    }

    public function litigationOrderDetail()
    {
        return $this->hasOne(LitigationOrderDetail::class);
    }

    public function orderTimeDate()
    {
        return $this->hasOne(OrderTimeDate::class);
    }



}
