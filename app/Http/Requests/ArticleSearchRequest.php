<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleSearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            's' => ['string','required'],
        ];
    }
}