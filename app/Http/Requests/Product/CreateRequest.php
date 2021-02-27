<?php

namespace App\Http\Requests\Product;

use App\Entity\Characteristic;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $productCharacteristicsTable = (new Characteristic())->getTable();

        return [
            'name' => 'required|min:3|max:255',
            'price' => 'required|integer',
            'characteristics' => 'nullable|array',
            'characteristic_ids.*' => ['required', 'integer', "exists:{$productCharacteristicsTable},id"],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'characteristic_ids' => array_keys($this->input('characteristics', []))
        ]);
    }
}
