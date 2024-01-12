<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasImage;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class Controller_User extends Controller{
    
    use HasImage;

    public function edit($lang, $id) {
        if(!is_numeric($id))
            return abort(404);
        
        $user = User::with('roles')->where("id", $id);
        if(!$this->isRootUser())
            $user = $user->doesntHave('roles', 'or', function ($query) {
                $query->where('name', "admin");
            });

        $user = $user->first();
        if(!$user)
            return abort(404);
        
        $roles = Role::where("name", "!=", "admin")->get();
        $userRole = $user->roles->pluck("name")->toArray();
        if(count($userRole) > 0){
            $userRole = $userRole[0];
        }else{
            $userRole = "";
        }
        return view("admin.pages.user.item")->with("model", $user)->with("roles", $roles)->with("userRole", $userRole);
    }

    public function process(Request $request){
        $request->validate([
            "id" => "required|integer",
            "email" => "required|string|max:255",
            "phone" => "nullable|string|max:255",
            "first_name" => "nullable|string|max:255",
            "second_name" => "nullable|string|max:255",
            "last_name" => "nullable|string|max:255",
            "passport" => "nullable|string|max:255",
            "telegram" => "nullable|string|max:255",
        ]);

        $model = User::where("id", $request->id);
        if(!$this->isRootUser())
            $model = $model->doesntHave('roles', 'or', function ($query) {
                $query->where('name', "admin");
            });

        $model = $model->first();
        if(!$model){
            return $this->responseErrorValidation(["undefined" => __("common.data_fail")]);
        }
        
        // $model->email = $request->email;
        $model->phone = $request->phone;
        $model->first_name = $request->first_name;
        $model->second_name = $request->second_name;
        $model->last_name = $request->last_name;
        $model->passport = $request->passport;
        $model->telegram = $request->telegram;
        $model->save();
        return $this->responseSuccess();
    }

    public function process_role(Request $request){
        $request->validate([
            "id" => "required|integer",
            "roleId" => "required|integer",
        ]);

        $model = User::where("id", $request->id);
        if(!$this->isRootUser())
            $model = $model->doesntHave('roles', 'or', function ($query) {
                $query->where('name', "admin");
            });

        $model = $model->first();
        if(!$model){
            return $this->responseErrorValidation(["undefined" => __("common.data_fail")]);
        }

        if($request->roleId == 0){
            $model->syncRoles([]);
            return $this->responseSuccess();
        }

        $role = Role::where("name", "!=", "admin")->where("id", $request->roleId)->first();
        if(!$role){
            return $this->responseErrorValidation(["undefined" => __("common.data_fail")]);
        }

        $model->assignRole($role->name);
        return $this->responseSuccess();
    }
}
