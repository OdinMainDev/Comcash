<?php

namespace App\Services\Bot\Response\Callbackquery;

class Router
{

    public $query;
    public $command;
    public $data;
    public $user;
    public $bot;
    public function __construct($query, $user){
        $this->query = $query;
        $explode = explode(":;:", $query->getData());
        $this->command = $explode[0];
        $this->data = "";
        if(count($explode) > 1)
            $this->data = $explode[1];
        $this->user = $user;
        $this->bot = $user->getBot;
    }

    
    public function exec(){
        switch($this->command) {
            
        }
        
    }

}