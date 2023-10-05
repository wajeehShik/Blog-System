<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //  \App\Models\Admin::factory(50)->create();
        // \App\Models\user::factory(300)->create();
        // \App\Models\Tag::factory(500)->create();
        // \App\Models\Faq::factory(10)->create();
        $this->call([

            PermissionTableSeeder::class,
            CreateUsersSeeder::class,
            // PostsTableSeeder::class,
            // PostTagSeeder::class,
        ]);
        \App\Models\Category::factory(1000)->create();
        \App\Models\Tag::factory(500)->create();
    }
}
