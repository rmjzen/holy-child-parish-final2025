<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentRequest extends Model
{
    protected $fillable = [
        'document_type',
        'full_name',
        'email',
        'marriage_date',
        'marriage_place',
        'location',
        'spouse_name',
        'child_name',
        'birthdate',
        'father_name',
        'mother_name',
    ];

     public function booking()
    {
        return $this->hasOne(Booking::class, 'reference_id');
    }
}
