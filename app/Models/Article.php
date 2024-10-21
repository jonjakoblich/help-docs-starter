<?php

namespace App\Models;

use App\States\ArticleStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\ModelStates\HasStates;

class Article extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    use HasFactory, HasStates;

    protected $attributes = [
        'order' => 10,
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

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class,'author_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
