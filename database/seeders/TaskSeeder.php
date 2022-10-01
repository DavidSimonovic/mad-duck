<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\TodoList;
use App\Models\User;
use Carbon\Carbon;
use Faker;
use Illuminate\Database\Seeder;

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

        for ($i = 0; $i < 150; $i++) {

            $user = User::inRandomOrder()->first();
            $todoList = TodoList::where('user_id',$user->id)->inRandomOrder()->first();


            Task::create([
                'task_title' => $faker->word,
                'task_description' => $faker->text(60),
                'status' => $faker->boolean,
                'user_id' => $user->id,
                'todo_list_id' => $todoList->id,
                'urgency' => config('todo_urgency.important'),
                'deadline' => Carbon::today()->subDays(5),
            ]);
            Task::create([
                'task_title' => $faker->word,
                'task_description' => $faker->text(60),
                'status' => $faker->boolean,
                'user_id' => $user->id,
                'todo_list_id' => $todoList->id,
                'urgency' => config('todo_urgency.normal'),
                'deadline' => Carbon::today()->subDays(15),
            ]);

            Task::create([
                'task_title' => $faker->word,
                'task_description' => $faker->text(60),
                'status' => $faker->boolean,
                'user_id' => $user->id,
                'todo_list_id' => $todoList->id,
                'urgency' => config('todo_urgency.can_be_delayed'),
                'deadline' => Carbon::today()->subDays(20),
            ]);
        }
    }
}
