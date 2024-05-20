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
        /**Users */
        \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        /**Websites */
        foreach($website_list as $website){
            Website::create([
                "name" => $website['name'],
                "url" => $website['url']
            ]);
        }

        /**Passwords */
        \App\Models\Password::factory(10)->create();


        /**Shared passwords */
        \App\Models\SharedPassword::factory()->create([
            "valid" => 1,
            "id_owner" => 1,
            "id_receiver" => 2,
            "id_password" => 3
        ]);
        \App\Models\SharedPassword::factory()->create([
            "valid" => 1,
            "id_owner" => 2,
            "id_receiver" => 1,
            "id_password" => 2
        ]);

        /**IpAddresses */
        \App\Models\IpAddress::factory()->create([
            "okLoginNum" => 1,
            "badLoginNum" => 0,
            "lastBadLoginNum" => 0,
            "permanentLock" => 0,
            "tempLock" => date("Y-m-d H:i:s"),
            "addressIP" => "192.178.1.0",
            "id_user" => 1
        ]);

        /**Login attempts */
        \App\Models\LoginAttempt::factory()->create([
            "successful" => 1,
            "device" => "Windows 10",
            "session" => "session",
            "id_user" => 1,
            "id_address" => 1
        ]);
    }
}
