<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Follow extends Model
{
    use HasFactory, Uuid;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'user_followed_id',
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
      'user_followed_id' => 'string',
    ];

    // public function user(): BelongsTo
    // {
    //   return $this->belongsTo(User::class, 'user_followed_id');
    // }
}
