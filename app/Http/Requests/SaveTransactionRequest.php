<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Auth\Guard;

class SaveTransactionRequest extends Request
{
    /**
     *  Determine if the user is authorized to make this request.
     *
     * @param Guard $auth
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
            'customer_id' => 'required|exists:customers,id',
            'pawn_amount' => 'required|numeric',
            'item_name' => 'required|min:3',
            'item_value' => 'required|numeric'
        ];
    }
}
