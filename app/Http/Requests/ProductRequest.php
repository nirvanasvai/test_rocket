<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use function PHPUnit\Framework\countOf;

class ProductRequest extends FormRequest
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
            'name'=>'nullable',
            'slug'=>'nullable',
            'article'=>'nullable',
            'description'=>'nullable',
            'specifications'=>'nullable',
            'benefits'=>'nullable',
            'price'=>'nullable|max:250',
            'sale'=>'nullable',
            'image'  => 'nullable',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
//        $image = count($this->input('image'));
//        foreach(range(0, $image) as $index) {
//            $rules['image.' . $index] = 'image|mimes:jpeg,bmp,png|max:2000';
//        }
//
//        return $rules;
    }
}
