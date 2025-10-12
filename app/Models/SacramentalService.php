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
        'user_id', // add this
    ];

    protected $casts = [
        'date' => 'date:Y-m-d', // cast to date and output in YYYY-MM-DD format
        'time' => 'string',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function booking()
    {
        return $this->hasOne(Booking::class, 'reference_id');
    }
}
