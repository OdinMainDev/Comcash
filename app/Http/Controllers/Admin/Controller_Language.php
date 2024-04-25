<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Models\HasCache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use JoeDixon\Translation\Language;
use JoeDixon\Translation\Translation;

class Controller_Language extends Controller
{
    use HasCache;
    
    public function view_export() {
        return view("admin.pages.languages.export")->with("groups", $this->getGroups());
    }

    public function process_export(Request $request) {
        $request->validate([
            "language" => "required|in:".implode(",", config("app.languages")),
            "group"  => "required|in:".implode(",", $this->getGroups()),
        ]);
        $language = Language::where("language", $request->language)->first();
        if(!$language){
            abort(404);
            return;
        }
        $translations = Translation::where("language_id", $language->id)->where("group", $request->group)->select('group', 'key', 'value')->get();
        $csvFileName = 'translations_'.$request->language.'_'.$request->group.'.csv';
        $directoryPath = storage_path('app/public/');
        $csvPath = $directoryPath . $csvFileName;

        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        $handle = fopen($csvPath, 'w');
        fputcsv($handle, ['group', 'key', 'value']);  // Write CSV header

        foreach ($translations as $row) {
            fputcsv($handle, [$row->group, $row->key, $row->value]);
        }

        fclose($handle);

        return response()->download($csvPath);
    }

    private function getGroups() {
        $path = resource_path('lang/ru');
        $files = File::allFiles($path);
        $groups = array_map(function ($file) {
            return str_replace('.php', '', $file->getRelativePathname());
        }, $files);
        return $groups;
    }

    public function view_import() {
        return view("admin.pages.languages.import");
    }

    public function process_import(Request $request){
        $request->validate([
            "language" => "required|in:".implode(",", config("app.languages")),
            "csv" => "required|file"
        ]);
        $file = $request->file('csv');
        $csvData = array_map('str_getcsv', file($file->path()));
        $language = Language::where("language", $request->language)->first();
        if(!$language){
            abort(404);
            return;
        }
        foreach ($csvData as $index => $row) {
            if ($index == 0) continue;  // Skip header row

            ['group' => $group, 'key' => $key, 'value' => $value] = array_combine(['group', 'key', 'value'], $row);
            $translation = Translation::where("language_id", $language->id)->where("group", $group)->where("key", $key)->first();
            if(!$translation){
                continue;
            }
            $translation->value = $value;
            $translation->save();
        }

        return $this->responseSuccess();
    }
}
