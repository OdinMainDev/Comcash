<?php
     
namespace App\Http\Traits\Misc;

use Spatie\ImageOptimizer\OptimizerChain;
use App\Models\File;
use Illuminate\Support\Facades\Auth;

trait HasImage {

    public function uploadImage($request, $name = "image"){
        if (!$request->hasFile($name))
            return false;
        
        $hash = sha1_file($request->file($name)->path());
        $check = File::where("hash", $hash)->first();
        if($check)
            return $check->path;
        
        $file = $request->file($name);
        $image_name = time().".".uniqid().".".$file->getClientOriginalExtension();
        $path = $file->move(public_path()."/uploads/", $image_name);
        app(OptimizerChain::class)->optimize($path);
        return $this->saveImage($image_name, $hash);
    }

    public function saveImage($image_name, $hash){
        $user = Auth::user();
        $log = new File;
        $log->hash = $hash;
        $log->path = $image_name;
        $log->user_id = $user ? $user->id : 0;
        $log->created_at = time();
        $log->save();
        return "/uploads/".$image_name;
    }

}