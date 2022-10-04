<?php

namespace App\Console\Commands;

use App\Mail\CompletedTasks;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

/**
 *
 */
class SendDailyMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:mails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends email to show how many tasks are completed that day.';


    /**
     * @return void
     */
    public function handle()
    {
        $userCount = User::all()->count();

        for ($i = 0; $i < $userCount / 100; $i++) {

            $users = User::skip($i * 100)
                ->take(100)
                ->get();

            foreach ($users as $user){

            $endOfTheDay = Carbon::now()->endOfDay();
            $userTime = Carbon::now($user->timezone->name);

            if ($userTime->format('H:i') === $endOfTheDay->format('H:i')) {

                $task_count = Task::where('user_id', $user->id)
                    ->where('status', true)
                    ->where('created_at', Carbon::now())
                    ->count();

                Mail::to($user->email)->send(new CompletedTasks($task_count));
            }
        }}

    }
}
