<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarriageCertificate extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'marriage_date',
        'marriage_place',
        'location',
        'spouse_name',
    ];
}
