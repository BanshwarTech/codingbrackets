<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceContent extends Model
{
    protected $table = 'service_contents';

    protected $fillable = [
        'service_id',
        'title',
        'slug',
        'short_heading',
        'main_heading',
        'main_content',
        'features_heading',
        'image',
        'features',
        'status',
    ];

    public function service()
    {
        return $this->belongsTo(Services::class);
    }
}
