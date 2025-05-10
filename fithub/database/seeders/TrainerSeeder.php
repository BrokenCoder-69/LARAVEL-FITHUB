<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Trainer;

class TrainerSeeder extends Seeder
{
    public function run()
    {
        Trainer::insert([
            ['name' => 'Rifat', 'specialty' => 'Weight Training', 'is_premium' => true],
            ['name' => 'Fahad', 'specialty' => 'Yoga', 'is_premium' => true],
            ['name' => 'Faiyaz', 'specialty' => 'Cardio', 'is_premium' => true],
            ['name' => 'Rafi', 'specialty' => 'CrossFit', 'is_premium' => true],
        ]);
    }
}
