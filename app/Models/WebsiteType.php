<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteType extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'icon',
        'status',
        'created_at',
        'updated_at',
    ];
}
