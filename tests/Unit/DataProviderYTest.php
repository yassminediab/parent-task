<?php

namespace Tests\Unit;

use App\Adapter\Implementation\JsonReader;
use App\DataProviders\Implementations\DataProviderY;
use App\Entities\UserEntity;
use Tests\TestCase;

class DataProviderYTest extends TestCase
{
    protected $dataProviderX;
    protected $jsonReader;

    public function setUp(): void
    {
        parent::setUp();

        $this->jsonReader = \Mockery::mock(JsonReader::class);
        $this->dataProviderX = new DataProviderY($this->jsonReader);
    }

    /**
     *
     */
    public function testMapDataOnUserEntityTest()
    {
        $users = collect([['balance' => 32 , 'currency' => 'sd' , 'email' => 'xx@xx.xx' , 'status' => 100 , 'created_at' => '11-11-1111' , 'id' => '121'] ]);
        $this->jsonReader->shouldReceive('readFile')
            ->andReturn($users)
            ->once();
        $user = new UserEntity();
        $user->setAmount(32)->setCurrency('sd')->setEmail('xx@xx.xx')->setIdentification('121')->setStatusCode('authorised')->setRegistrationDate('11-11-1111');
        $expected = collect()->push($user);
        $actual = $this->dataProviderX->mapDataOnUserEntity();
        $this->assertEquals($expected , $actual);
    }


}
