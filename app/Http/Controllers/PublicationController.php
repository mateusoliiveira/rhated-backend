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
       //return $this->model->get();
    return DB::table("publications")
    ->leftJoin("users", function($join){
      $join->on("publications.user_id", "=", "users.id");
    })
    ->select("users.id", "publications.id", "publications.body", "publications.created_at")
    ->where("publications.user_id", "=", $this->request->authedUser()['id'])
    ->whereIn("publications.user_id", function($query){
      $query->from("follows")
      ->select("user_followed_id")
      ->where("user_id", "=", $this->request->authedUser()['id']);
    })
    ->orderBy("publications.created_at","desc")
    ->get();
    }

    // public function indexWith()
    // {
    //    return $this->model->with('vehicles.brands')->get();
    // }

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

    // public function insert()
    // {
    //    return $this->model->insert((array_map(fn($request): array => [
    //      "id" => UuidV4::uuid4(),
    //      "created_at" => now(),
    //      "updated_at" => now(),
    //      ...$request
    //    ], $this->request->all())));
    // }

    public function show($id)
    {
       return $this->model->show($id);
    }

    // public function with($id)
    // {
    //    return $this->model->with('vehicles')->find($id);
    // }

    public function destroy($id)
    {
       return $this->model->delete($id);
    }
}
