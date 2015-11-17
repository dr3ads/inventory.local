<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Auth\Guard;

class SaveAdditionalTransactionRequest extends Request
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
            'parent_id' => 'required|exists:processes,id',
            'customer_id' => 'required|exists:processes,customer_id',
            'item_id' => 'required|exists:processes,item_id',
            'pawn_amount' => 'required|numeric',
        ];
    }
}
