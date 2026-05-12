<?php

namespace Database\Seeders;

use App\Models\Make;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $makes = [
            'Honda',
            'Toyota',
            'Nissan',
            'Mazda',
            'Subaru',
            'Mitsubishi',
            'BMW',
            'Audi',
            'Volkswagen',
            'Porsche',
            'Mercedes',
            'Renault',
            'Peugeot',
            'Ford',
            'Chevrolet',
            'Dodge',
            'Hyundai',
            'Kia',
            'Alfa Romeo',
            'Seat',
            'Volvo',
            'Polestar',
            'Lexus',
        ];

        foreach ($makes as $make) {
            Make::create(['name' => $make]);
        }
    }
}
