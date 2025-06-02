<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZipCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'city',
        'state',
        'county',
        'id_state',
        'id_county',
        'zip',
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
