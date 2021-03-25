<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\Types\True_;
use function Matrix\trace;

class MainRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_name'=> 'required|min:1,max:40',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description'=> 'required|min:5,max:250'
        ];
    }
}
