<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_address',
        'street',
        'city',
        'state',
        'zip_code',
        'apt_number',
        'country',
        'zip_code_id',
    ];

    public function applicants()
    {
        return $this->hasMany(Applicant::class);
    }

    public function zipCode()
    {
        return $this->belongsTo(ZipCode::class);
    }
}
