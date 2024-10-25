<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CastVoteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'vote' => ['boolean','required'],
        ];
    }
}