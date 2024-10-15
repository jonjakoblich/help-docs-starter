<?php

use App\Models\Article;

uses()->group('policies','article');

beforeEach(function(){
    $this->article = Article::factory()->create();
});

describe('logged in users',function(){
    test('can edit an article', function () {
        //expect()->
    })->todo();
    
    test('can create an article', function () {
        //expect()->
    })->todo();
});

describe('guests can', function(){
    test('view articles', function () {
        //
    })->todo();

    test('not edit an article', function () {
        $this->article->update();
    });
    
    test('not create an article', function () {
        //expect()->
    });
});
