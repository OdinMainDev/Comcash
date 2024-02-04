<?php

namespace App\Observers;

use Laravel\Octane\Events\RequestReceived;

class OctaneObserver{
    //

    public function handle(RequestReceived $event){
       dd("TEST");
       app()->register('JoeDixon\Translation\TranslationServiceProvider');
    }
}
