<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'discount_percentage', 'start_date', 'end_date'];
    public function roomTypes()
    {
        return $this->belongsToMany(RoomType::class, 'room_type_amenity');
    }
}
