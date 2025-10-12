<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BaptismalCertificate extends Model
{
    use HasFactory;

    protected $casts = [
        'date' => 'date:Y-m-d', // cast to date and output in YYYY-MM-DD format          // if you want booking date as Carbon
    ];
    protected $fillable = [
        'user_id',
        'child_name',
        'birthdate',
        'father_name',
        'mother_name',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
