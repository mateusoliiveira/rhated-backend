<?php

namespace App\Http\Controllers;
use App\Http\Requests\FollowRequest;
use App\Repositories\Contracts\FollowRepositoryInterface;

use function PHPUnit\Framework\isNull;

class FollowController extends Controller
{
    protected $model;
    protected $request;
    public function __construct(
        FollowRepositoryInterface $model,
        FollowRequest $request
        )
    {
        $this->model = $model;
        $this->request = $request;
    }

    public function index()
    {
      $user = $this->request->authedUser();
      $toFollow = $this->request->all();
      $followData = [
        "user_id" => $user->id,
        "user_followed_id" => $toFollow["user_followed_id"]
      ];

      $checkIfAlreadyFollow = $this->model
      ->where('user_id', '=', $followData["user_id"])
      ->where('user_followed_id', '=', $followData["user_followed_id"])
      ->get();

      if(count($checkIfAlreadyFollow) === 0) {
        return $this->model->create($followData);
      } else {
        return $this->model->delete($checkIfAlreadyFollow);
      }
    }
}
