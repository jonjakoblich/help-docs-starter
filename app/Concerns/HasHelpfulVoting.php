<?php

namespace App\Concerns;

use App\Models\HelpfulVote;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasHelpfulVoting
{
    public function votes(): MorphMany
    {
        return $this->morphMany(HelpfulVote::class, 'voteable');
    }
}