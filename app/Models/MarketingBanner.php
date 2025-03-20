<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketingBanner extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'image_url',
        'url',
        'description',
        // 'start_date',
        // 'end_date',
    ];
}
