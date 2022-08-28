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

    public function index()
    {
      $user = $this->request->authedUser();
      return $this->model
        ->with('profile')
        ->with('following')
        ->with('publications.profile')
        ->withCount('publications')
        ->find($user->id);
    }

    public function show($id)
    {
      return $this->model
        ->with('profile')
        ->with('following')
        ->with('publications.profile')
        ->withCount('publications')
        ->find($id);
    }
    public function showByNicknameOrName($param)
    {
      return $this->model
      ->leftJoin("profiles", "profiles.user_id", "=", "users.id")
      ->select(
        "users.id",
        "users.full_name",
        "profiles.nickname",
        "profiles.biography"
      )
        ->where('full_name','ILIKE',"%{$param}%")
        ->orWhere('profiles.nickname','ILIKE',"%{$param}")
      ->get();
    }

    public function store()
    {
        $userData = [
          "email" => $this->request->userHashed()["email"],
          "password" => $this->request->userHashed()["password"],
          "full_name" => $this->request->userHashed()["full_name"],
        ];
        $user = $this->model->create($userData);

        $userProfile = [
          "user_id" => $user->id,
          "first_name" => explode(" ", $userData["full_name"])[0],
          "nickname" => $this->request->userHashed()["nickname"],
          "biography" => 'Olá!'
        ];
        $profile = $this->externalModelProfile->create($userProfile);

        return response()->json([
            'message' => 'Conta criada com sucesso, seja bem vindo!',
            ["user" => $user, "profile" => $profile],
        ], 201);
    }
}
