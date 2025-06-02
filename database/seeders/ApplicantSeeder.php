<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Applicant;
use App\Models\Address;
use Illuminate\Support\Str;

class ApplicantSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $address = Address::create([
                'street' => 'Street ' . $i,
                'city' => 'City ' . $i,
                'state' => 'State',
                'zip_code' => '7500' . $i,
                'country' => 'USA',
            ]);

            Applicant::create([
                'name' => 'Name' . $i,
                'surname' => 'Surname' . $i,
                'email' => 'applicant' . $i . '@example.com',
                'phone' => str_pad(strval(mt_rand(0, 9999999999)), 10, '0', STR_PAD_LEFT),
                'car' => $i % 2 === 0 ? 'Yes' : 'No',
                'address_id' => $address->id,
            ]);
        }
    }
}
