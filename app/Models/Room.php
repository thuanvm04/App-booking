<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Room extends Model
{

    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = ['room_type_id', 'name','image_thumbnail',  'price', 'description', 'availability_status', 'is_active'];
   
    protected $casts = [
        'price' => 'integer',
        'is_active' => 'boolean',
        'availability_status' => 'boolean',
        
    ];
    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function images()
    {
        return $this->hasMany(RoomImage::class);
    }
}
