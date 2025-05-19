<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceOffer extends Model
{
    use HasFactory;
    protected $table = 'service_offers';
    protected $fillable = [
        'offer_title',
        'offer_description',
        'offer_image',
        'status',
        'button_text',
        'button_link',
    ];
}
