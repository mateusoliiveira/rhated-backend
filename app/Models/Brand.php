<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Brand extends Model
{
    use HasFactory, Uuid;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'picture'
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

    /**
     * Get the cars of the Brand
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }
}
