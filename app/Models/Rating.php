<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Rating extends Model
{
    use HasFactory, Uuid;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'user_rated_id',
        'publication_id',
        'rating'
    ];

    protected function uuidVersion(): int
    {
        return 4;
    }

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $casts = [
      'id' => 'string',
      'user_id' => 'string',
      'user_rated_id' => 'string',
      'publication_id' => 'string',
      'rating' => 'number',
    ];
}
