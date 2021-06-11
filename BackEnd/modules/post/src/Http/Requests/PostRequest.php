<?php

namespace Modules\Post\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        if ($this->has('id')) {
            return [
                'title' => 'required',
                'slug' => 'required',
                'content' => 'required',
                'category_id' => 'required',
                'image' => 'required',
            ];
        }
        return [
            'title' => 'required',
            'slug' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'image' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => trans('post::notification.title'),
            'slug.required' => trans('post::notification.slug'),
            'content.required' => trans('post::notification.content_post'),
            'category_id.required' => trans('post::notification.category_id'),
            'image.required' => trans('post::notification.image'),
        ];
    }
}
