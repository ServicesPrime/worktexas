<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        Job::create(['name' => 'Roofer', 'description' => 'Roof repair and installation']);
        Job::create(['name' => 'Plumber', 'description' => 'Installation and repair of water systems']);
        Job::create(['name' => 'Electrician', 'description' => 'Electrical installations and troubleshooting']);
        Job::create(['name' => 'Painter', 'description' => 'Interior and exterior painting services']);
        Job::create(['name' => 'Bricklayer', 'description' => 'Construction and repair of walls and floors']);
        Job::create(['name' => 'Carpenter', 'description' => 'Woodwork: furniture, doors, cabinets']);
        Job::create(['name' => 'Floor Installer', 'description' => 'Installation of tile, vinyl, or laminate flooring']);
        Job::create(['name' => 'Gardener', 'description' => 'Yard maintenance and landscaping']);
        Job::create(['name' => 'Mobile Mechanic', 'description' => 'Basic vehicle repairs at location']);
        Job::create(['name' => 'HVAC Technician', 'description' => 'Air conditioning and heating repair']);
        Job::create(['name' => 'Cleaner', 'description' => 'Residential and commercial cleaning services']);
        Job::create(['name' => 'Locksmith', 'description' => 'Lock repair and emergency opening services']);
        Job::create(['name' => 'Window Installer', 'description' => 'Installation and repair of windows and doors']);
        Job::create(['name' => 'General Helper', 'description' => 'Lifting, moving, and general assistance']);
        Job::create(['name' => 'Handyman', 'description' => 'Minor home repairs and fixes']);
        Job::create(['name' => 'Welder', 'description' => 'Metal welding and fabrication tasks']);
        Job::create(['name' => 'Mover', 'description' => 'Home and office moving help']);
        Job::create(['name' => 'Tile Setter', 'description' => 'Tile installation and repair']);
        Job::create(['name' => 'Drywall Installer', 'description' => 'Drywall hanging, patching, and finishing']);
        Job::create(['name' => 'Housekeeper', 'description' => 'Detailed house cleaning and maintenance']);
        Job::create(['name' => 'Pool Cleaner', 'description' => 'Cleaning and chemical treatment for pools']);
        Job::create(['name' => 'Fence Installer', 'description' => 'Fence construction and repair']);
        Job::create(['name' => 'Solar Panel Installer', 'description' => 'Installation of solar systems']);
        Job::create(['name' => 'Window Cleaner', 'description' => 'Cleaning exterior and high-rise windows']);
        Job::create(['name' => 'Trash Removal', 'description' => 'Junk and debris removal services']);
        Job::create(['name' => 'Pest Control Technician', 'description' => 'Extermination and pest control solutions']);
        Job::create(['name' => 'Security System Installer', 'description' => 'Setup of alarms and cameras']);
        Job::create(['name' => 'Gutter Cleaner', 'description' => 'Cleaning and unclogging rain gutters']);
        Job::create(['name' => 'Appliance Repair Technician', 'description' => 'Repair of washers, dryers, ovens, etc.']);
        Job::create(['name' => 'Lawn Mower', 'description' => 'Grass cutting and lawn care']);
    }
}
