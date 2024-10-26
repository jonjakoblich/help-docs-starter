<?php

namespace App\States;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class ArticleStatus extends State
{
    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Draft::class)
            ->allowTransitions([
                [[Published::class,Archived::class,Hidden::class], Draft::class],
                [[Draft::class,Archived::class,Hidden::class], Published::class],
                [[Draft::class,Archived::class,Published::class], Hidden::class],
                [[Draft::class,Hidden::class,Published::class], Archived::class],
            ])
            //->allowAllTransitions()
            ;
    }
}