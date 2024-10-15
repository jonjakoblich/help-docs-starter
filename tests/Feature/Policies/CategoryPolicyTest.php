<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use function Pest\Laravel\actingAs;

uses()->group('policies','category');

beforeEach(function(){
    $this->category = Category::factory()->create();
});

describe('logged in users',function(){
    test('can edit a Category', function () {
        actingAs(User::factory()->create());
        
        expect(Auth::user()->can('update',$this->category))
            ->toBeTrue();
    });
    
    test('can create a Category', function () {
        actingAs(User::factory()->create());
        
        expect(Auth::user()->can('create',Category::class))
            ->toBeTrue();
    });

    test('can view any Categories', function () {
        actingAs(User::factory()->create());

        expect(Auth::user()->can('viewAny',Category::class))
            ->toBeTrue();
    });

    test('can delete an Category', function () {
        actingAs(User::factory()->create());

        expect(Auth::user()->can('delete',$this->category))
            ->toBeTrue();
    });

});

describe('guests can', function(){
    test('view Categories', function () {
        expect(Gate::allows('view',$this->category))
            ->toBeTrue();
    });

    test('not edit a Category', function () {
        expect(Gate::allows('update',$this->category))
            ->toBeFalse();
    });
    
    test('not create a Category', function () {
        expect(Gate::allows('create',$this->category))
            ->toBeFalse();
    });
    
    test('not delete a Category', function () {
        expect(Gate::allows('delete',$this->category))
            ->toBeFalse();
    });
});
