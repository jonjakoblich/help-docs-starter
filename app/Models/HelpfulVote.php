<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class HelpfulVote extends Model
{
    /** @use HasFactory<\Database\Factories\HelpfulVoteFactory> */
    use HasFactory;

    protected $fillable = [
        'vote',
        'ip_address',
    ];

    public function voteable(): MorphTo
    {
        return $this->morphTo();
    }
}
