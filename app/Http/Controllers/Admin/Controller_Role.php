<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasImage;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Controller_Role extends Controller
{
    use HasImage;
    
    public function getAuthUserPermissions(){
        return Auth::user()->getAllPermissions();
    }

    public function add() {
        return view("admin.pages.roles.item")
        ->with("model", new Role)
        ->with("permissions", $this->getAuthUserPermissions()->pluck("name")->toArray())
        ->with("choosen_permissions", []);
    }

    public function edit($lang, $id) {
        if(!is_numeric($id))
            return abort(404);
        
        $model = Role::with("permissions")->where("id", $id)->where("name", "!=", "admin")->first();
        if(!$model)
            return abort(404);

        return view("admin.pages.roles.item")
        ->with("model", $model)
        ->with("permissions", $this->getAuthUserPermissions()->pluck("name")->toArray())
        ->with("choosen_permissions", $model->permissions->pluck("name")->toArray());
    }

    public function process(Request $request){
        $permissions = $this->getAuthUserPermissions();
        $request->validate([
            "name" => "required|string|max:255|not_in:admin",
            "permissions" => "nullable|array",
            "permissions.*" => "required|string|in:".implode(",", $permissions->pluck("name")->toArray()),
            "id" => "nullable|integer|min:2"
        ]);
        

        $model = new Role;
        if($request->has("id") && $request->id){
            $model = Role::where("id", $request->id)->first();
            if(!$model){
                return $this->responseErrorValidation(["undefined" => __("common.data_fail")]);
            }
        }

        $check = Role::where("name", $request->name);
        if($model->id){
            $check = $check->where("id", "!=", $model->id);
        }

        if($check->first()){
            return $this->responseErrorValidation(["name" => __("common.role_name_already_exist")]);
        }

        $model->name = $request->name;
        $model->save();

        foreach($permissions as $permission){
            if(is_array($request->permissions) && in_array($permission->name, $request->permissions)){
                $model->givePermissionTo($permission);
            }else{
                $model->revokePermissionTo($permission);
            }
        }
        return $this->responseSuccess();
    }
}
