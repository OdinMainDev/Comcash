<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasImage;
use App\Jobs\TelegramSpam;
use App\Models\TelegramBot;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class Controller_UserSpam extends Controller{
    
    use HasImage;

    public function tg_view() {
        $bots = TelegramBot::where("status", true)->get();
        return view("admin.pages.user.spam_tg")->with("bots", $bots);
    }

    public function tg_process(Request $request) {
        $request->validate([
            'messageTg' => 'required|string|max:4000',
            'telegramId' => 'required|integer|exists:App\Models\TelegramBot,id',
            'language' => 'required|string|in:all,'.implode(",", config()->get("app.languages")),
        ]);
        TelegramSpam::dispatch($request->telegramId, $request->messageTg, $request->language);
        return $this->responseSuccess();
    }
}
