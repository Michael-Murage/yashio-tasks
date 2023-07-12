<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        echo("Seeding tags...\n");
        $tags = ["laravel", "docker", "ubuntu", "ubuntu-20.04", "laravel-sail"];

        for ($i = 0; $i < count($tags); $i++) {
            \App\Models\Tag::create([
                'name' => $tags[$i]
            ]);
        }
        
        echo("Seeding successful!\n");
    }
}
