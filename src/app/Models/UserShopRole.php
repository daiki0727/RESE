<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserShopRole extends Model
{
    use HasFactory;

    protected $table = 'user_shop_role';

    protected $fillable = [
        'user_id',
        'role_id',
        'shop_id',
    ];
}
