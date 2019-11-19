<?php
namespace App\DataProviders;

use Illuminate\Support\Collection;

interface IDataProvider{

    /**
     * @return string
     */
    public function getFileName() :string ;

    /**
     * @return Collection
     */
    public function mapDataOnUserEntity() : Collection;

    /**
     * @return array
     */
    public function getStatusCodes() : array;
}
