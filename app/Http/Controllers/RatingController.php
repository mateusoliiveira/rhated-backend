<?php

namespace App\Http\Controllers;
use App\Http\Requests\RatingRequest;
use App\Repositories\Contracts\PublicationRepositoryInterface;
use App\Repositories\Contracts\RatingRepositoryInterface;

class RatingController extends Controller
{
    protected $model;
    protected $request;
    public function __construct(
      RatingRepositoryInterface $model,
      PublicationRepositoryInterface $externalModelPublication,
      RatingRequest $request
    )
    {
        $this->model = $model;
        $this->externalModelPublication = $externalModelPublication;
        $this->request = $request;
    }

    public function store()
    {
      $user = $this->request->authedUser();
      $rating = $this->request->validated();

      $checkIfAuthedAlreadyRatedThisPost = $this->model
      ->where("user_id", '=', $user->id)
      ->where("publication_id", '=', $rating["publication_id"])
      ->get();

     // if(count($checkIfAuthedAlreadyRatedThisPost) > 0) return response()->json([
     //   'message' => 'Postagem já curtida'
     // ], 401);;

      $publication = $this->externalModelPublication->show($rating["publication_id"]);
      $ratingData = [
              "user_id" => $user->id,
              "user_rated_id" => $publication->user_id,
              "publication_id" => $publication->id,
              "rating" => $rating["rating"]
      ];
      return $this->model->create($ratingData);
    }
}
