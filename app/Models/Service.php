<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'icon', 'image', 'description', 'price'];

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_service');
    }
}
