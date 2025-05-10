<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembershipSeeder extends Seeder
{
    public function run()
    {
        DB::table('memberships')->insert([
            [
                'name' => 'Silver',
                'price' => 500,
                'features' => 'Basic gym access, 2 trainer sessions per month'
            ],
            [
                'name' => 'Gold',
                'price' => 700,
                'features' => 'Full gym access, 5 trainer sessions, group classes'
            ],
            [
                'name' => 'Platinum',
                'price' => 1000,
                'features' => 'All Gold features + personal diet plan + unlimited trainer sessions'
            ],
        ]);
    }
}

