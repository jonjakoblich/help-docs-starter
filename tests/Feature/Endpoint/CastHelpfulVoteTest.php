<?php

use App\Models\Article;
use App\Models\HelpfulVote;

use function Pest\Laravel\post;

uses()->group('endpoints');

beforeEach(function(){
    $this->article = Article::factory()->published()->create();
});

it('requires a boolean vote value', function () {
    $data = [
        'vote' => '',
    ];

    post(route('article.cast-vote',$this->article->slug), $data)
        ->assertSessionHasErrors([
            'vote' => 'The vote field must be true or false.',
        ])
        ->assertSessionHasErrors([
            'vote' => 'The vote field is required.'
        ]);
});

it('stores the vote data', function () {
    test()->assertDatabaseCount(HelpfulVote::class, 0);

    $data = [
        'vote' => true,
    ];

    post(route('article.cast-vote',$this->article->slug), $data)
        ->assertSessionDoesntHaveErrors();

    test()->assertDatabaseHas(HelpfulVote::class, [
        'voteable_id' => $this->article->id,
        'vote' => $data['vote'],
        'ip_address' => '127.0.0.1',
    ]);
});

it('does not store the vote data if same IP address tries to vote again', function () {
    test()->assertDatabaseCount(HelpfulVote::class, 0);

    $data = [
        'vote' => true,
    ];

    $this->article->votes()->save(
        new HelpfulVote([
            'vote' => $data['vote'],
            'ip_address' => '127.0.0.1',
        ])
    );

    post(route('article.cast-vote',$this->article->slug), $data)
        ->assertSessionHasErrors();

    test()->assertDatabaseCount(HelpfulVote::class, 1);
});
