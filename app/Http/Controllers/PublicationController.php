<?php

namespace App\Http\Controllers;
use App\Http\Requests\PublicationRequest;
use App\Repositories\Contracts\FollowRepositoryInterface;
use App\Repositories\Contracts\PublicationRepositoryInterface;

class PublicationController extends Controller
{
    protected $model;
    protected $request;
    public function __construct(
      PublicationRepositoryInterface $model,
      FollowRepositoryInterface $externalModelFollow,
      PublicationRequest $request
    )
    {
        $this->model = $model;
        $this->externalModelFollow = $externalModelFollow;
        $this->request = $request;
    }

    public function index()
    {
      $authedUser = $this->request->authedUser();

      $usersThatAuthedUserFollow = $this->externalModelFollow
      ->where("user_id", "=", $authedUser->id)
      ->select("user_followed_id")
      ->get();

      return $this->model
      ->leftJoin("users", "publications.user_id", "=", "users.id")
      ->leftJoin("profiles", "publications.user_id", "=", "profiles.user_id")
      ->select(
        "publications.id",
        "profiles.nickname",
        "profiles.user_id",
        "publications.body",
        "publications.created_at")
      ->where("publications.user_id", "=", $authedUser->id)
      ->orWhereIn("publications.user_id", $usersThatAuthedUserFollow)
      ->latest()
      ->get();
    }

    public function show($id)
    {
       return $this->model->with('profile')->with('ratings')->find($id);
    }

    public function store()
    {
      $user = $this->request->authedUser();
      $publication = $this->request->validated();
      $publicationData = [
              "user_id" => $user->id,
              "body" => $publication["body"]
      ];
      return $this->model->create($publicationData);
    }

    public function destroy($id)
    {
       return $this->model->delete($id);
    }
}
