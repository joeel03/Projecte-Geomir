<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Visibility;


class VisibilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Visibility::create(['id' => 1, 'name' => 'public']);
        Visibility::create(['id' => 2, 'name' => 'contacts']);
        Visibility::create(['id' => 3,  'name' => 'private']);
    }
}
