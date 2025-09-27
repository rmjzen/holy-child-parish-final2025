<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaptismalCertificate extends Model
{
        protected $fillable = [
        'child_name',
        'birthdate',
        'father_name',
        'mother_name',
    ];

}
