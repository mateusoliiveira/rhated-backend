<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserController extends Controller
{
    protected $model;
    protected $modelOffer;
    protected $request;
    public function __construct(
        UserRepositoryInterface $model,
        UserRequest $request
        )
    {
        $this->model = $model;
        $this->request = $request;
    }

    public function store()
    {
        $user = $this->model->create($this->request->userHashed());
        return response()->json([
            'message' => 'Conta criada com sucesso, seja bem vindo!',
            $user,
        ], 201);
    }
}
