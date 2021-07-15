<?php

namespace App\Http\Requests;

use App\Models\Promocode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CartPromocodeRequest extends FormRequest
{
    public function rules() {
        return [
            'code' => [
                'required',
                Rule::exists((new Promocode)->getTable(), 'code')
            ]
        ];
    }

}
