<?php

namespace Database\Seeders;

use App\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Tag::factory()->count(10)->create();
    }
}
