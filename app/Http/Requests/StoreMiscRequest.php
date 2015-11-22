<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Auth\Guard;

class StoreMiscRequest extends Request
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
            'flow' => 'required',
            'type' => 'required',
            'amount' => 'required|numeric',
            'description' => 'required'
        ];
    }
}
