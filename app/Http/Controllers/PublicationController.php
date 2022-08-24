<?php

namespace App\Http\Controllers;
use App\Http\Requests\PublicationRequest;
use App\Repositories\Contracts\PublicationRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Rfc4122\UuidV4;

class PublicationController extends Controller
{
    protected $model;
    protected $request;
    public function __construct(
        PublicationRepositoryInterface $model,
        PublicationRequest $request
        )
    {
        $this->model = $model;
        $this->request = $request;
    }

    public function index()
    {
      $user = $this->request->authedUser();
      return $this->model->where('user_id', '=', $user->id)->get();
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

    public function show($id)
    {
       return $this->model->show($id);
    }

    public function destroy($id)
    {
       return $this->model->delete($id);
    }
}
