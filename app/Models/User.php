<?php

namespace App\Models;

use App\Enums\DaycareStatusEnum;
use App\Enums\DaycareTypeEnum;
use App\Enums\UserTypeEnum;
use App\Traits\HasAttachment;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasAttachment;

    protected $table = 'users';

    protected $guarded = [];

    public $timestamps = true;

    // protected array $dates = ['deleted_at'];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    

    public function phone(): Attribute
    {

        return Attribute::make(
            get: fn($value) => $value !== null ? '+966' . $value : null,
        );
    }

// scopes

// relations
    public function fcmTokens(): HasMany
    {
        return $this->hasMany(Token::class);
    }

    public function userDetails(): HasOne
    {
        return $this->hasOne(UserDetails::class);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }
   
}
