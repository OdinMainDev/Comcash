<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Models\HasCache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class Controller_EmailTemplate extends Controller
{
    use HasCache;
    
    public function view_choose() {
        $path = resource_path('views/'.$this->theme.'/mails');
        $files = File::allFiles($path);
        $emails = array_map(function ($file) {
            return str_replace('.blade.php', '', $file->getRelativePathname());
        }, $files);
        return view("admin.pages.emails.choose")->with("emails", $emails);
    }

    public function view_item(Request $request, $lang, $email) {
        $viewPath = $this->theme . ".mails." . $email;
        if (view()->exists($viewPath)) {
            return view($viewPath);
        }
        return response()->json(['error' => 'Email template not found.'], 404);
    }
}
