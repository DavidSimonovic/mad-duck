<?php

namespace Database\Seeders;

use App\Models\Timezone;
use App\Models\User;
use Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 *
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $timezone = Timezone::inRandomOrder()->first();

            User::create([
                'username' => $faker->username,
                'email' => $faker->email,
                'password' => Hash::make('123456789'),
                'timezone_id' => $timezone->id,

            ]);
        }

        User::create([
            'username' => 'davidUsername',
            'email' => 'david@test.com',
            'password' => Hash::make('123456789'),
            'timezone_id' => $timezone->id,
        ]);
    }
}
