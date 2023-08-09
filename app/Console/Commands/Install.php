<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Permission;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Basic installation';
    public $admin_role = null;
    public $admin_user = null;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->line("Start installation");
        $this->createUploadDirectory();
        $this->createRoles();
        $this->createAdmin();
        $this->createPermissions();
    }

    public function createUploadDirectory(){
        if(!File::isDirectory(public_path()."/uploads")){
            File::makeDirectory(public_path()."/uploads");
            $this->info("Created upload direcory");
            $this->line("");
        }
    }

    public function createRoles(){
        $this->line("Create role admin");
        $role = Role::where("name", "admin")->first();
        if($role){
            $this->warn("Admin role already created");
            $this->admin_role = $role;
            return;
        }
        $role = Role::create(['name' => 'admin']);
        $this->admin_role = $role;

        $this->line("");
        $this->info("Admin role created");
        return;
    }

    public function createAdmin(){
        $this->line("Create admin");
        $user = User::where("email", env("INSTALL_ADMIN_EMAIL", "admin@admin.ru"))->first();
        if($user){
            $this->admin_user = $user;
            $this->warn("User already created");
            return;
        }
        $user = new User;
        $user->name = env("INSTALL_ADMIN_EMAIL", "admin@admin.ru");
        $user->email = env("INSTALL_ADMIN_EMAIL", "admin@admin.ru");
        $user->password = Hash::make(env("INSTALL_ADMIN_PASSWORD", "admin@admin.ru"));
        $user->save();
        $this->admin_user = $user;

        $this->line("");
        $this->info("User vioriel created");
    }

    public function createPermissions(){
        $this->line("Create Permissions");
        $permissions = [
            "view-dashboard",
            "handle-currencies",
        ];

        $bar = $this->output->createProgressBar(count($permissions));
        $bar->start();
        foreach ($permissions as $key){
            $bar->advance();
            $permission = Permission::where('name', $key)->first();
            if($permission){
                $this->admin_user->givePermissionTo($permission);
                continue;
            }
            $permission = Permission::create(['name' => $key]);
            $this->admin_user->givePermissionTo($permission);
        }
        $bar->finish();
        $this->line("");
        $this->line("Permissions created");
    }
}
