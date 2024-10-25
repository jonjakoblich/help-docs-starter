<?php

namespace App\Http\Controllers;

use App\Http\Requests\CastVoteRequest;
use App\Models\Article;
use App\Models\HelpfulVote;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CastHelpfulVoteController extends Controller
{
    public function __invoke(Article $article, CastVoteRequest $request)
    {
        $castVote = new HelpfulVote([
            'vote' => $request->validated('vote'),
            'ip_address' => $request->ip(),
        ]);

        Validator::make(
            [$request->ip()],
            ['*' => Rule::notIn($article->votes->pluck('ip_address'))],
            ['*' => 'You have already voted. Thank you for your vote!']
        )->validate();

        $article->votes()->save($castVote);
    }
}