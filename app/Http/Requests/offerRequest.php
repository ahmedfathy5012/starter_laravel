<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class offerRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name_ar'=>'required|max:100',
            'name_en'=>'required|max:100',
            'price'=>'required|numeric',
        ];
    }

    protected  function message(){
        return [
            "name_ar.required" => __('messages.offer name required'),
            "name_er.required" => __('messages.offer name required'),
            "price.required" => 'Name Is Required'
        ];
    }
}
