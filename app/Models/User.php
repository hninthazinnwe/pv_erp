<?php

namespace App\Models;

use App\Traits\HasAutoKey;
use App\Traits\HasCode;
use App\Traits\HasUUID;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUUID, HasCode, HasAutoKey, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'uuid')->withDefault();
    }

    public function user_locations()
    {
        // return $this->hasMany(Location::class,'uuid','location_uuid');
        return $this->belongsToMany(Location::class,UserLocations::class, 'user_uuid', 'location_uuid', 'uuid', 'uuid');

        // return $this->belongsToMany('App\VehicleClass', 'vehicleclass_feature', 'vehicleclass_id', 'feature_id');
    }
}
