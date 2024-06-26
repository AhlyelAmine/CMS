<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title'=>'bail|required|max:200',
            'content'=>'required',
            'picture'=>'image',
            'youtube'=>'min:6'
        ];
    }
        /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'A title is required',
            'youtube.min' => 'The youtube url must be at least 5 characters',
            'content.required' => 'A content is required',
            'title.max' => 'The title may not be greater than 200 characters',
            'picture.image' => 'The picture must be an image',

        ];
    }
}
