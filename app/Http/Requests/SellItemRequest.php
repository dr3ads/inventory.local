<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Auth\Guard;

class SellItemRequest extends Request
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
            'item_id' => 'required',
            'customer_id' => 'required|exists:customers,id',
            'item_sell_price' => 'required'
        ];
    }
}
