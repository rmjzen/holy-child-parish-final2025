<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'booking_type',
        'reference_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function sacramental()
    {
        return $this->belongsTo(SacramentalService::class, 'reference_id');
    }

    public function marriageCertificate()
    {
        return $this->belongsTo(MarriageCertificate::class, 'reference_id');
    }

    public function baptismalCertificate()
    {
        return $this->belongsTo(BaptismalCertificate::class, 'reference_id');
    }
}
