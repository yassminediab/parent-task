<?php

namespace Tests\Unit;

use App\Adapter\Implementation\JsonReader;
use App\DataProviders\Implementations\DataProviderY;
use App\Entities\FilterEntity;
use App\Entities\UserEntity;
use App\Filters\Implementations\FilterUsers;
use Tests\TestCase;

class FilterUserTest extends TestCase
{
    protected $filterUsers;

    public function setUp(): void
    {
        parent::setUp();

        $this->filterUsers = new FilterUsers();
    }

    public function testFilterUserWithStatusCodeTest()
    {
        $user = new UserEntity();
        $user->setAmount(32)->setCurrency('sd')->setEmail('xx@xx.xx')->setIdentification('121')->setStatusCode('authorised')->setRegistrationDate('11-11-1111');
        $users = collect()->push($user);

        $filters = new FilterEntity();
        $filters->setStatusCode('authorised');

        $user = new UserEntity();
        $user->setAmount(32)->setCurrency('sd')->setEmail('xx@xx.xx')->setIdentification('121')->setStatusCode('declined')->setRegistrationDate('11-11-1111');
        $users->push($user);

        $user = new UserEntity();
        $user->setAmount(32)->setCurrency('sd')->setEmail('xx@xx.xx')->setIdentification('121')->setStatusCode('authorised')->setRegistrationDate('11-11-1111');
        $expected = collect()->push($user);

        $actual = $this->filterUsers->filterUsers($filters,$users);
        $this->assertEquals($expected , $actual);
    }

    public function testFilterUserWithCurrencyTest()
    {
        $user = new UserEntity();
        $user->setAmount(32)->setCurrency('AED')->setEmail('xx@xx.xx')->setIdentification('121')->setStatusCode('authorised')->setRegistrationDate('11-11-1111');
        $users = collect()->push($user);

        $filters = new FilterEntity();
        $filters->setCurrency('AED');

        $user = new UserEntity();
        $user->setAmount(32)->setCurrency('sd')->setEmail('xx@xx.xx')->setIdentification('121')->setStatusCode('declined')->setRegistrationDate('11-11-1111');
        $users->push($user);

        $user = new UserEntity();
        $user->setAmount(32)->setCurrency('AED')->setEmail('xx@xx.xx')->setIdentification('121')->setStatusCode('authorised')->setRegistrationDate('11-11-1111');
        $expected = collect()->push($user);

        $actual = $this->filterUsers->filterUsers($filters,$users);
        $this->assertEquals($expected , $actual);
    }

    public function testFilterUserWithAmountTest()
    {
        $user = new UserEntity();
        $user->setAmount(32)->setCurrency('AED')->setEmail('xx@xx.xx')->setIdentification('121')->setStatusCode('authorised')->setRegistrationDate('11-11-1111');
        $users = collect()->push($user);

        $filters = new FilterEntity();
        $filters->setMinAmount(20)->setMaxAmount(40);


        $user = new UserEntity();
        $user->setAmount(92)->setCurrency('sd')->setEmail('xx@xx.xx')->setIdentification('121')->setStatusCode('declined')->setRegistrationDate('11-11-1111');
        $users->push($user);

        $user = new UserEntity();
        $user->setAmount(32)->setCurrency('AED')->setEmail('xx@xx.xx')->setIdentification('121')->setStatusCode('authorised')->setRegistrationDate('11-11-1111');
        $expected = collect()->push($user);

        $actual = $this->filterUsers->filterUsers($filters,$users);
        $this->assertEquals($expected , $actual);
    }


}
