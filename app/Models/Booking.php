<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'room_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'check_in_date',
        'check_out_date',
        'booking_date',
        'total_amount',
        'code_order',
        'note',
        'status'
    
    ];
    protected $casts = [
        'total_amount' => 'float',
        
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
