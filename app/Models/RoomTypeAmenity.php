<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomTypeAmenity extends Model
{
    use HasFactory;
    protected $fillable = ['room_type_id','amenity_id'];
    public function roomTypes()
    {
        return $this->belongsToMany(RoomType::class);
    }
}
