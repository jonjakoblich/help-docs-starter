<?php

use App\Models\Article;
use App\Models\HelpfulVote;
use Illuminate\Database\Eloquent\Model;

uses()->group('models','helpful-votes');

beforeEach(function(){
    $this->vote = HelpfulVote::factory()
        ->for(Article::factory(), 'voteable')
        ->create();
});

it('has a boolean vote property', function () {
    expect($this->vote)->vote
        ->toBeBool();
});

it('has an IP address property', function () {
    expect($this->vote)->ip_address
        ->not->toBeNull()
        ->toBeString();
});

it('has a voteable model property', function () {
    expect($this->vote)->voteable
        ->toBeInstanceOf(Model::class);
});
