<?php

namespace App\Console\Commands;

use App\Models\Merchant;
use Illuminate\Console\Command;

class FillMerchant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fill-merchant';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Merchant::truncate();
        Merchant::insert([
            [
                // "id" => 1,
                "name" => "Garantex",
                "type" => "garantex",
                "status" => false,
                "created_at" => now()
            ],
            [
                // "id" => 2,
                "name" => "MPCVip",
                "type" => "mpcvip",
                "status" => false,
                "created_at" => now()
            ],
            [
                // "id" => 3,
                "name" => "Bybit",
                "type" => "bybit",
                "status" => false,
                "created_at" => now()
            ],
            [
                // "id" => 4,
                "name" => "Aifory",
                "type" => "aifory",
                "status" => false,
                "created_at" => now()
            ],
        ]);
    }
}
