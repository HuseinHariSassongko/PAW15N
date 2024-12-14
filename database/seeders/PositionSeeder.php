<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    public function run(): void
    {
        Position::create([
            'name' => 'Front End Developer',
            'code' => 'FE'
        ]);

        Position::create([
            'name' => 'Back End Developer',
            'code' => 'BE'
        ]);

        Position::create([
            'name' => 'System Analist',
            'code' => 'SA'
        ]);
    }
}
