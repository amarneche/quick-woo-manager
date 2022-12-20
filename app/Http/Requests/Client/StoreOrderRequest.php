<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => [],
            "phone" => [],
            "wilaya_id"=>['required'],
            "commune"=>[],
            "delivery"=>[],
            "product_qty"=>[],
            "product_id"=>[],
        ];
    }
}
