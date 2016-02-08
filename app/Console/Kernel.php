<?php

namespace App\Console;

use DB;
use App\Users;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')
                 ->hourly();
    }

    protected function removeUnconfirmedUsers(Schedule $schedule)
    {
        $schedule->call(function () {
            $users = Users::where('is_confirmed', 'no')
            ->where('time_created', '<=', date('Y-m-d h:i:s',strtotime("-1 days")));
            foreach($users as $user)
            {
                $user->delete();
            }
            })->daily();
    }

}
