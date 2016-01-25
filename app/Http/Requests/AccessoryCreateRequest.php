<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Auth\Guard;

class AccessoryCreateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Guard $auth)
    {
        return $auth->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'unit_price' => 'numeric',
        ];
    }
}
