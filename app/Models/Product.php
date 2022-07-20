<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "description",
        "price",
        "image"
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy("created_at", "DESC");
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class)->orderBy("created_at", "DESC");
    }
}
