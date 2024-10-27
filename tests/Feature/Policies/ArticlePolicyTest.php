<?php

use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use function Pest\Laravel\actingAs;

uses()->group('policies','article');

beforeEach(function(){
    $this->article = Article::factory()->published()->create();
});

describe('logged in users',function(){
    test('can edit an article', function () {
        actingAs(User::factory()->create());
        
        expect(Auth::user()->can('update',$this->article))
            ->toBeTrue();
    });
    
    test('can create an article', function () {
        actingAs(User::factory()->create());
        
        expect(Auth::user()->can('create',Article::class))
            ->toBeTrue();
    });

    test('can view any articles', function () {
        actingAs(User::factory()->create());

        expect(Auth::user()->can('viewAny',Article::class))
            ->toBeTrue();
    });

    test('can delete an article', function () {
        actingAs(User::factory()->create());

        expect(Auth::user()->can('delete',$this->article))
            ->toBeTrue();
    });

});

describe('guests can', function(){
    test('view articles', function () {
        expect(Gate::allows('view',$this->article))
            ->toBeTrue();
    });

    test('not edit an article', function () {
        expect(Gate::allows('update',$this->article))
            ->toBeFalse();
    });
    
    test('not create an article', function () {
        expect(Gate::allows('create',$this->article))
            ->toBeFalse();
    });
    
    test('not delete an article', function () {
        expect(Gate::allows('delete',$this->article))
            ->toBeFalse();
    });
});
