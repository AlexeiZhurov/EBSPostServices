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
        (new PostFactory())->count(100)->create();
        (new VoiceFactory())->count(100)->create();

    }
}
