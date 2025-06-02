<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Applicant;
use App\Models\Address;

class ApplicantSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $address = Address::create([
                'full_address' => '123 Street ' . $i,
                'street'       => 'Street ' . $i,
                'city'         => 'City ' . $i,
                'state'        => 'TX',
                'zip_code'     => '7700' . $i,
                'apt_number'   => 'Apt ' . $i,
                'country'      => 'USA',
            ]);

            Applicant::create([
                'name'       => 'Name' . $i,
                'surname'    => 'Surname' . $i,
                'email'      => 'applicant' . $i . '@example.com',
                'phone'      => '832555' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'car'        => $i % 2 === 0 ? 'Yes' : 'No',
                'address_id' => $address->id,
            ]);
        }
    }
}
