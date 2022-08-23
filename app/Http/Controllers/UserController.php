<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Repositories\Contracts\ProfileRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserController extends Controller
{
    protected $model;
    protected $modelOffer;
    protected $request;
    public function __construct(
      UserRepositoryInterface $model,
      ProfileRepositoryInterface $externalModelProfile,
      UserRequest $request
        )
    {
        $this->model = $model;
        $this->externalModelProfile = $externalModelProfile;
        $this->request = $request;
    }

    public function store()
    {
        $userData = [
          "email" => $this->request->userHashed()["email"],
          "password" => $this->request->userHashed()["password"],
          "fullname" => $this->request->userHashed()["fullname"],
        ];
        $user = $this->model->create($userData);

        $profileData = [
          "user_id" => $user->id,
          "first_name" => explode(" ", $this->request->userHashed()["fullname"])[0],
          "nickname" => $this->request->userHashed()["nickname"],
        ];
        $profile = $this->externalModelProfile->create($profileData);

        return response()->json([
            'message' => 'Conta criada com sucesso, seja bem vindo!',
            ["user" => $user, "profile" => $profile],
        ], 201);
    }
}
