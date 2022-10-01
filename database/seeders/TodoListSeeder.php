<?php

namespace Database\Seeders;

use App\Models\TodoList;
use App\Models\User;
use Carbon\Carbon;
use Faker;
use Illuminate\Database\Seeder;

class TodoListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 50; $i++) {

            $user = User::inRandomOrder()->first();

            TodoList::create([
                'title' => $faker->word,
                'description' => $faker->text(60),
                'user_id' => $user->id,
            ]);

        }

    }
}
