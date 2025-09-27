<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SacramentalService extends Model
{
    protected $fillable = [
        'service_type',
        'date',
        'time',
        'location',
        'full_name',
        'contact_number',
    ];
}
