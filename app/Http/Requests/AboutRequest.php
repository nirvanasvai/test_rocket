<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutRequest extends FormRequest
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
            'description'         => 'nullable',
            'advantages'          => 'nullable',
            'block_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'main_principe'      => 'nullable',
            'assurance'      => 'nullable',
            'icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'page_type'      => 'nullable',
            'meta_title' => 'nullable',
            'meta_description' => 'nullable'
        ];
    }
}
?>

