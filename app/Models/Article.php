<?php

namespace App\Models;

use App\Concerns\HasHelpfulVoting;
use App\States\ArticleStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\ModelStates\HasStates;

class Article extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    use HasFactory, HasStates, HasHelpfulVoting;

    protected $attributes = [
        'order' => 10,
        'featured' => false,
    ];

    protected $casts = [
        'status' => ArticleStatus::class,
    ];

    protected $fillable = [
        'name',
        'content',
        'author_id',
        'slug',
    ];

    protected $with = [
        'categories'
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('ordered', fn(Builder $query) => $query->orderBy('order'));
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class,'author_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
