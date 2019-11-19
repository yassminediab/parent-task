<?php
namespace App\Service;

use App\Entities\FilterEntity;
use Illuminate\Support\Collection;

interface IUserService{

    /**
     * @param FilterEntity $filter
     * @return Collection
     */
    public function getData(FilterEntity $filter) : Collection;
}
