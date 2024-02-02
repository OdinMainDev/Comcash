<?php

namespace App\Console\Commands;

use App\Models\Direction;
use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class FillSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fill-sitemap';

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
        $generator = SitemapGenerator::create(env("APP_URL"));
        // $directions = Direction::where("status", true)->chunk(10, function($rows) use($generator) {
        //     foreach($rows as $row){
        //        $generator->add(Url::create('/extra-page')->setPriority(0.5));
        //     }
        // });
        // $generator->writeToFile(public_path('sitemap.xml'))
        sendTelegramNotification("SITEMAP СГЕНЕРИРОВАН УСПЕШНО");
    }
}
