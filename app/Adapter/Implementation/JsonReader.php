<?php
namespace App\Adapter\Implementation;

use App\Adapter\IJsonReader;
use Illuminate\Support\Collection;

class JsonReader implements IJsonReader {

    /**
     * @param $file
     * @return Collection
     */
    public function readFile($file): Collection
    {
        $json = file_get_contents(storage_path('data/'.$file));
        $array = json_decode($json, true);
        return collect($array['users']);
    }
}