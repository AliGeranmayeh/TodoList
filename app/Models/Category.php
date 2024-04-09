<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Scopes\UserCategoryScope;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'user_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new UserCategoryScope());
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class);
    }
}
