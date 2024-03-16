<?php

namespace App\Jobs;

use App\Models\TelegramBot;
use App\Models\TelegramUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TelegramSpam implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $bot_id;
    public $bot;
    public $message;
    public $language;

    public $timeout = null;

    public function __construct($id, $message, $language = 'all')
    {
        $this->bot_id = $id;
        $this->message = $message;
        $this->language = $language;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->bot = TelegramBot::where("id", $this->bot_id)->first();
        $this->message = str_replace("<br />", "", $this->message);
        $query = TelegramUser::where("is_member", true);
        if($this->language != "all" && in_array($this->language, config()->get("app.languages"))){
            $query = $query->where("language", $this->language);
        }
        $query->where("bot_id", $this->bot->telegram_id)->chunk(100, function($rows){
            sleep(1);
            $count = 0;
            foreach($rows as $row){
                if($count == 3){
                    $count = 0;
                    sleep(1);
                }
                sendTelegramBotUserMessage($this->message, $row, $this->bot);
                $count++;
            }
       });
    }
}
