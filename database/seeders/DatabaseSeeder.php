<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Posts;
use App\Models\Categories;
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
        User::create([
            'name'=>'Guntur',
            'username'=>'gunzxx',
            'email'=>'gunzxx@mail.com',
            'password'=>bcrypt('12345'),
        ]);
        
        User::factory(5)->create();
        
        Categories::create([
            'name'=>'Personal',
            'slug'=>'personal'
        ]);
        
        Categories::create([
            'name'=>'Web Design',
            'slug'=>'web-design'
        ]);
        
        Categories::create([
            'name'=>'Web Programming',
            'slug'=>'web-programming'
        ]);
        
        Posts::factory(100)->create();
    }
}
