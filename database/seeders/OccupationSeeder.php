<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Occupation;

class OccupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $occupations = [
            'Developer',
            'Designer',
            'Manager',
            'Analyst',
            'Engineer',
            'Consultant',
            'Teacher',
            'Accountant',
            'Doctor',
            'Nurse',
            'Lawyer',
            'Marketing Specialist',
            'Sales Representative',
        ];

        foreach ($occupations as $occupation) {
            Occupation::create(['name' => $occupation]);
        }
    }
}
