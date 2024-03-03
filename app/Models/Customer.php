<?php

namespace App\Models;

// use App\Traits\HasUUID;

use App\Traits\HasAutoKey;
use App\Traits\HasCode;
use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, HasUUID, HasCode, HasAutoKey, SoftDeletes;
    protected $guarded = ['dob'];
}
