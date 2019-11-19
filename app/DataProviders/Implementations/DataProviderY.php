<?php
namespace App\DataProviders\Implementations;

use App\Adapter\IJsonReader;
use App\DataProviders\IDataProvider;
use App\Entities\UserEntity;
use Illuminate\Support\Collection;

class DataProviderY implements IDataProvider {

    /**
     * @var IJsonReader
     */
    protected $jsonReader;

    /**
     * UserService constructor.
     * @param IJsonReader $IJsonReader
     */
    public function __construct(IJsonReader $IJsonReader)
    {
       $this->jsonReader = $IJsonReader;
    }

    /**
     * @return string
     */
    public function getFileName() : string
    {
        return 'DataProviderY.json';
    }

    /**
     * @return Collection
     */
    public function mapDataOnUserEntity(): Collection
    {
        $users = $this->jsonReader->readFile($this->getFileName());
        $usersEntities = collect();
        $users->each(function ($user) use (&$usersEntities){
            $entity = new UserEntity();
            $entity->setAmount($user['balance'])->setStatusCode($this->getStatusCodes()[$user['status']])
                ->setCurrency($user['currency'])->setRegistrationDate($user['created_at'])->setEmail($user['email'])
                ->setIdentification($user['id']);
            $usersEntities->push($entity);
        });
        return $usersEntities;
    }

    /**
     * @return array
     */
    public function getStatusCodes(): array
    {
        return [
             100 => 'authorised',
             200 => 'declined',
             300 => 'refunded'
        ];
    }
}
