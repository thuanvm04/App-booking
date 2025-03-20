<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomTypePromotions extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_type_id',
        'promotion_id',
    ];
    public function roomTypes()
    {
        return $this->belongsToMany(RoomType::class, 'room_type_promotions');
    }
}
