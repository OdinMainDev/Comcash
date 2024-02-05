<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use JoeDixon\Translation\Drivers\Database;
use JoeDixon\Translation\Drivers\File;
use JoeDixon\Translation\Translation;
use JoeDixon\Translation\Language;
use JoeDixon\Translation\Scanner;

class SyncLanguages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-languages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronise translations between drivers';

    /**
     * File scanner.
     *
     * @var Scanner
     */
    private $scanner;

    /**
     * Translation.
     *
     * @var Translation
     */
    private $translation;
    private $fromDriver;
    private $toDriver;
    private $languages = [];

   
    public function __construct(Scanner $scanner, Translation $translation)
    {
        parent::__construct();
        $this->scanner = $scanner;
        $this->translation = $translation;
    }

   
    public function handle()
    {
        $this->fromDriver = $this->createDriver('file');
        $this->toDriver = $this->createDriver('database');
        $translations = $this->mergeLanguages($this->toDriver, $this->fromDriver->allTranslations());
        $this->info('Translations have been synced');
    }

    private function createDriver($driver)
    {
        if ($driver === 'file') {
            return new File(new Filesystem, app('path.lang'), config('app.locale'), $this->scanner);
        }

        return new Database(config('app.locale'), $this->scanner);
    }

    private function mergeLanguages($driver, $languages)
    {
        foreach ($languages as $language => $translations) {
            $this->mergeTranslations($driver, $language, $translations);
        }
    }

    private function mergeTranslations($driver, $language, $translations)
    {
        $this->mergeGroupTranslations($driver, $language, $translations['group']);
    }

    private function mergeGroupTranslations($driver, $language, $groups)
    {
        foreach ($groups as $group => $translations) {
            foreach ($translations as $key => $value) {
                if (is_array($value)) {
                    continue;
                }
                try {
                    $driver->addLanguage($language);
                } catch(Exception $ex) {}
                $this->addGroupTranslation($language, $group, $key, $value);
            }
        }
    }

    private function addGroupTranslation($language, $group, $key, $value) {
        if(!isset($this->languages[$language])){
            $this->languages[$language] = Language::where('language', $language)->first();
        }
        $check = Translation::where("language_id", $this->languages[$language]->id)->where("group", $group)->where("key", $key)->first();
       
        if($check){
            return;
        }

        $check = new Translation;
        $check->language_id = $this->languages[$language]->id;
        $check->group = $group;
        $check->key = $key;
        $check->value = $value;
        $check->save();
    }
}
