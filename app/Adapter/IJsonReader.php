<?php
namespace App\Adapter;

use Illuminate\Support\Collection;

interface IJsonReader{

    /**
     * @param $file
     * @return Collection
     */
    public function readFile($file) :Collection;

}