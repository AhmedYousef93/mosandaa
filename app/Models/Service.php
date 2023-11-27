<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    
    public function title(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->{'title_'. app()->getLocale()}
        );
    }

    public function description(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->{'description_'. app()->getLocale()}
        );
    }
    public function subservices()
    {
        return $this->hasMany(Subservice::class);
    }
}
