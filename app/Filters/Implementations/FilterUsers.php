<?php
namespace App\Filters\Implementations;

use App\Entities\FilterEntity;
use App\Entities\UserEntity;
use App\Filters\IFilterUsers;
use Illuminate\Support\Collection;

class FilterUsers implements IFilterUsers {

    /**
     * @param FilterEntity $filter
     * @param Collection $users
     * @return Collection
     */
    public function filterUsers(FilterEntity $filter, Collection $users): Collection
    {
       $users = $users->filter(function (UserEntity $user) use ($filter){
           $flag = true;
           if($filter->getStatusCode() && $user->getStatusCode() != $filter->getStatusCode())
               $flag = false;
           if($filter->getCurrency() && $user->getCurrency() != $filter->getCurrency())
               $flag = false;
           if(($filter->getMaxAmount() && $filter->getMinAmount()) && ($user->getAmount() < $filter->getMinAmount() || $user->getAmount() > $filter->getMaxAmount()))
               $flag = false;

           return $flag;
       });
       return $users;
    }
}
