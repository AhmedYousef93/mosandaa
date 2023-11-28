<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function title(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->{'title_'. app()->getLocale()}
        );
    }
    public function areas()
    {
        return $this->hasMany(Area::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
