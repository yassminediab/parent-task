<?php

namespace App\Http\Controllers;

use App\Entities\FilterEntity;
use App\Service\IUserService;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use Spatie\Fractal\Fractal;

class UserController extends ApiController
{
    /**
     * @var IUserService
     */
    protected $userService;

    /**
     * UserController constructor.
     * @param IUserService $userService
     */
    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    public function getUsers(Request $request)
    {
        $filterEntity = new FilterEntity();
        $data = $request->all();
        $filterEntity->setCurrency(($data['currency']) ?? null)->setProvider(($data['provider']) ?? null)->setMinAmount(($data['min_amount']) ?? null)
            ->setMaxAmount(($data['max_amount']) ?? null)->setStatusCode(($data['statusCode']) ?? null);
        $users = $this->userService->getData($filterEntity);
        $users = Fractal::create($users,new UserTransformer())->toArray()['data'];
        return $this->respondAccepted('users retrieved successfully',$users);
    }
}
