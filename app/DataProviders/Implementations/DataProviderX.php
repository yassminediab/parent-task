<?php
namespace App\DataProviders\Implementations;

use App\Adapter\IJsonReader;
use App\DataProviders\IDataProvider;
use App\Entities\UserEntity;
use Illuminate\Support\Collection;

class DataProviderX implements IDataProvider {

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
        return 'DataProviderX.json';
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
            $entity->setAmount($user['parentAmount'])->setStatusCode($this->getStatusCodes()[$user['statusCode']])
                ->setCurrency($user['Currency'])->setRegistrationDate($user['registerationDate'])->setEmail($user['parentEmail'])
                ->setIdentification($user['parentIdentification']);
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
             1 => 'authorised',
             2 => 'declined',
             3 => 'refunded'
        ];
    }
}
