<?php

namespace Database\Seeders;

use App\Models\Applicant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ApplicantSeeder extends Seeder
{
    public function run(): void
    {
        $records = [];
        for ($i = 1; $i <= 10; $i++) {
            $records[] = [
                'name'       => 'Name ' . $i,
                'surname'    => 'Surname ' . $i,
                'email'      => 'applicant' . $i . '@example.com',
                'phone'      => str_pad((string)random_int(0, 9999999999), 10, '0', STR_PAD_LEFT),
                'car'        => $i % 2 === 0 ? 'Yes' : 'No',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('applicants')->insert($records);
    }
}
