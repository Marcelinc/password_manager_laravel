<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Website;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //Example Data
        $website_list = [
            [
                'name' => 'Youtube',
                'url' => 'https://www.youtube.com'
            ],[
                'name' => 'Facebook',
                'url' => 'https://www.facebook.com'
            ],[
                'name' => 'Instagram',
                'url' => 'https://www.instagram.com'
            ]
        ];

        //Seeders
        \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        
        foreach($website_list as $website){
            Website::create([
                "name" => $website['name'],
                "url" => $website['url']
            ]);
        }

        \App\Models\Password::factory(10)->create();


    }
}
