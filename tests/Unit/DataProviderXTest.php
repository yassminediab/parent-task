<?php

namespace Tests\Unit;

use App\Adapter\Implementation\JsonReader;
use App\DataProviders\Implementations\DataProviderX;
use App\Entities\UserEntity;
use Tests\TestCase;

class DataProviderXTest extends TestCase
{
    protected $dataProviderX;
    protected $jsonReader;

    public function setUp(): void
    {
        parent::setUp();

        $this->jsonReader = \Mockery::mock(JsonReader::class);
        $this->dataProviderX = new DataProviderX($this->jsonReader);
    }

    /**
     *
     */
    public function testMapDataOnUserEntityTest()
    {
        $users = collect([['parentAmount' => 32 , 'Currency' => 'sd' , 'parentEmail' => 'xx@xx.xx' , 'statusCode' => 1 , 'registerationDate' => '11-11-1111' , 'parentIdentification' => '121'] ]);
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
