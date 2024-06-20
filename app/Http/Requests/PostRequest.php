<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    /*public function authorize()
    {
        return false;
    }*/

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'post.place_name' => 'required|string|max:20',
            #'post.title_name' => 'string|max:20',
            #'post.genre' => 'string|max:20',
            #'post.area' => 'string|max:20',
            'post.information' => 'required|string|max:500',
            'post.latitude' => 'required|numeric|min:0.01',
            'post.longitude' => 'required|numeric|min:0.01',
            'post.category_title_id' => 'required',
            'post.category_genre_id' => 'required',
            'post.category_area_id' => 'required',
        ];
    }
}
