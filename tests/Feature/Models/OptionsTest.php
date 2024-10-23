<?php

use App\Models\Options;

beforeEach(function(){
    $this->siteOptions = Options::factory()->create();
});

it('has a theme color option', function () {
    expect($this->siteOptions->theme_color)
        ->not->toBeNull()
        ->toBeString()
        ->toStartWith('#');
});

it('has a logo option', function () {
    expect($this->siteOptions->logo_path)
        ->not->toBeNull()
        ->toBeString();
});

it('has a product name option', function () {
    expect($this->siteOptions->product_name)
        ->not->toBeNull()
        ->toBeString();
});

it('has a product home url option', function () {
    expect($this->siteOptions->product_url)
        ->not->toBeNull()
        ->toBeString();
});
