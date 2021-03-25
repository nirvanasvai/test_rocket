<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title'      => 'nullable',
            'name'      => 'nullable',
            'slug'               => 'nullable',
            'icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sales'               => 'nullable|max:1',
        ];
    }
}
?>

