<?php

namespace App\Jobs;

use App\Mail\TemplateMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class MailSpam implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $template;
    public $subject;

    public $timeout = null;

    public function __construct($template, $subject)
    {
        $this->template = $template;
        $this->subject = $subject;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $query = User::where('email', 'NOT LIKE', '@%');
        $query->chunk(100, function($rows){
            foreach($rows as $row){
                $view = new TemplateMail($row->email, $this->subject, $this->template);
                @Mail::to($row->email)
                ->send($view);
            }
       });
    }
}
