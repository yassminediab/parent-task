<?php
namespace App\Service\Implementation;

use App\Adapter\IJsonReader;
use App\DataProviders\Implementations\DataProviderX;
use App\DataProviders\Implementations\DataProviderY;
use App\Entities\FilterEntity;
use App\Filters\IFilterUsers;
use App\Service\IUserService;
use Illuminate\Support\Collection;

class UserService implements IUserService {

    /**
     * @var IFilterUsers
     */
    protected $filter;

    /**
     * UserService constructor.
     * @param IFilterUsers $filterUsers
     */
    public function __construct(IFilterUsers $filterUsers)
    {
       $this->filter = $filterUsers;
    }

    /**
     * @param FilterEntity $filter
     * @return Collection
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getData(FilterEntity $filter): Collection
    {
        if(!$filter->getProvider()) {
            $providers = $this->getProviders();
        }
        else {
            $providers = [$this->getProviders()[$filter->getProvider()]];
        }
        $users = collect();
        foreach ($providers as $providerClass) {
            $provider = app()->make($providerClass);
            $users = $users->merge($provider->mapDataOnUserEntity());
        }
        $users = $this->filter->filterUsers($filter,$users);
        return $users;
    }

    /**
     * @return array
     */
    public function getProviders()
    {
        return [
            'DataProviderX' => DataProviderX::class,
            'DataProviderY' => DataProviderY::class
        ];
    }
}
