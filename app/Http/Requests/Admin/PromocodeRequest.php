<?php

namespace App\Http\Requests\Admin;

use App\Models\Promocode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PromocodeRequest extends FormRequest
{
    public function rules()
    {
        $uniqueCode = Rule::unique((new Promocode)->getTable(), 'code');

        if ($promocode = $this->route('promocode'))
            $uniqueCode->ignoreModel($promocode);

        return [
            'code' => ['required', 'string', 'max:255', $uniqueCode],
            'discount' => ['required', 'integer', 'min:1', 'max:100']
        ];
    }
}
