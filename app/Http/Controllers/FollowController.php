<?php

namespace App\Http\Controllers;
use App\Http\Requests\FollowRequest;
use App\Repositories\Contracts\FollowRepositoryInterface;
use Ramsey\Uuid\Rfc4122\UuidV4;

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

    public function store()
    {
      $user = $this->request->authedUser();
      $toFollow = $this->request->validated();
      $followData = [
        "user_id" => $user->id,
        "user_followed_id" => $toFollow["user_followed_id"]
      ];
       return $this->model->create($followData);
    }

    public function destroy($id)
    {
       return $this->model->delete($id);
    }
}
