<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'q' => 'required|min:2',
        ];
    }
}
