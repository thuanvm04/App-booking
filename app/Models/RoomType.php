<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'image_thumbnail', 'people_amount', 'bed_amount', 'is_active'];
    protected $casts = [
        'is_active' => 'boolean',
    ];

    function rooms()
    {
        return $this->hasMany(Room::class);
    }
    public function promotions()
    {
        return $this->belongsToMany(Promotion::class, 'room_type_promotions');
    }
    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'room_type_amenities');
    }
}
