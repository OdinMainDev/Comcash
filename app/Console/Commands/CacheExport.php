<?php

namespace App\Console\Commands;

use App\Http\Traits\Models\HasCache;
use Illuminate\Console\Command;

class CacheExport extends Command
{
    use HasCache;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cache-export';

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
        $this->refreshCacheExportJson();
        $this->refreshCacheExportXml();
    }
}
