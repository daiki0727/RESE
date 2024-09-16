<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_name', 'area', 'genre', 'detail', 'image'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_shop_role', 'shop_id', 'user_id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function isFavorited()
    {
        return $this->favorites()->where('user_id', Auth::id())->exists();
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
