<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
 
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
