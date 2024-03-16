<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class FillEmailsUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fill-emails-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cache = Cache::get("users-emails-admin-cache");
        if($cache){
            return;
        }
        Cache::put("users-emails-admin-cache", "pending", 3600);
        $allEmails = ''; // Строка для хранения всех email

        User::where('email', 'not like', '@%')->orderBy('id')->chunk(1000, function ($users) use (&$allEmails) {
            foreach ($users as $user) {
                $allEmails .= $user->email . "\n"; // Добавляем каждый email в строку
            }
        });

        Cache::put('users-emails-admin-cache', $allEmails, 3600); // Сохраняем строку в кэше на 1 день


    }
}
