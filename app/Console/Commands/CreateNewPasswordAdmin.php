<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Permission;

class CreateNewPasswordAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:createnewadminpassword';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create New Password Admin';
    public $admin_role = null;
    public $admin_user = null;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->line("Start password generate");
        $user = User::where("email", env("INSTALL_ADMIN_EMAIL", "admin@admin.ru"))->first();
        $user->password = Hash::make($this->generateRandomString(22));
        $user->save();
    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
    
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
    
        return $randomString;
    }
}
