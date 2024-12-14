<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        Employee::create([
            'firstname' => 'Purnama',
            'lastname' => 'Anaking',
            'email' => 'purnama.anaking@gmail.com',
            'age' => 20,
            'position_id' => 1,  // Front End Developer
        ]);

        Employee::create([
            'firstname' => 'Adzanil',
            'lastname' => 'Rachmadhi',
            'email' => 'adzanil.rachmadhi@gmail.com',
            'age' => 25,
            'position_id' => 2,  // Back End Developer
        ]);

        Employee::create([
            'firstname' => 'Berlian',
            'lastname' => 'Rahmy',
            'email' => 'berlian.rahmy@gmail.com',
            'age' => 23,
            'position_id' => 3,  // System Analist
        ]);
    }
}
