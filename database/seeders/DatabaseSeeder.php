<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\PostFactory;
use Database\Factories\VoiceFactory;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        PostFactory::new()->count(100)->create();
        VoiceFactory::new()->count(100)->create();

    }
}
