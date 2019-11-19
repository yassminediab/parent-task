<?php
namespace App\Filters;

use App\Entities\FilterEntity;
use Illuminate\Support\Collection;

interface IFilterUsers{

    /**
     * @param FilterEntity $filter
     * @param Collection $users
     * @return Collection
     */
    public function filterUsers(FilterEntity $filter,Collection $users) : Collection;
}
