<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarriageCertificate extends Model
{
    protected $casts = [
        'date' => 'date',           // if you want booking date as Carbon
        'marriage_date' => 'date',  // the actual ceremony date
    ];
    protected $fillable = [
        'full_name',
        'email',
        'marriage_date',
        'marriage_place',
        'location',
        'spouse_name',
        'date',
        'user_id', // add this
        'date',
    ];

    public function booking()
    {
        return $this->hasOne(Booking::class, 'reference_id');
    }
}
