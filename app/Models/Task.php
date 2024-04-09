<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Scopes\UserTaskScope;

class Task extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'description',
        'user_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new UserTaskScope());
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
