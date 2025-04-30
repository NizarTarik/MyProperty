<?php

namespace Database\Seeders;

use App\Models\Box;
use App\Models\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Option;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Property::factory(10)->create();
        Option::factory(10)->create();
        User::factory(5)->create();
        Box::factory(100)->create();
    }
}
