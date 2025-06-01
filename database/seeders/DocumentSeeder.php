<?php

namespace Database\Seeders;

use App\Models\Document;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Document::insert([
            ['name' => 'idFront'],
            ['name' => 'idBack'],
            ['name' => 'security'],
            ['name' => 'selfie'],
            ['name' => 'cv'],
            ['name' => 'signature'],
        ]);
    }
}
