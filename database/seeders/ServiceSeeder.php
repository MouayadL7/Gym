<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            ['name' => 'Fitness'],
            ['name' => 'Yoga'],
            ['name' => 'Gym'],
            ['name' => 'Aerobics'],
            ['name' => 'Boxing'],
            ['name' => 'Body Building'],
            ['name' => 'Zumba']
        ];

        foreach ($services as $service) {
            Service::firstOrCreate(
                ['name' => $service['name']]
            );
        }
    }
}
