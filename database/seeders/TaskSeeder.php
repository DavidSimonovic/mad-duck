<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\TodoList;
use App\Models\User;
use Carbon\Carbon;
use Faker;
use Illuminate\Database\Seeder;

/**
 *
 */
class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $users = User::take(10);

        for ($i = 0; $i < 150; $i++) {

            $user = $users->inRandomOrder()->first();

            $todoList = TodoList::where('user_id', $user->id)->inRandomOrder()->first();


            Task::create([
                'task_title' => $faker->word,
                'task_description' => $faker->text(60),
                'status' => $faker->boolean,
                'user_id' => $user->id,
                'todo_list_id' => $todoList->id,
                'deadline' => Carbon::today()->subDays(+5),
            ]);

        }
    }
}
