<?php

namespace Modules\Post\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
                'slug' => 'required|unique:post_categories,slug,' . $this->id
            ];
        }
        return [
            'title' => 'required',
            'slug' => 'required|unique:post_categories,slug',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => trans('post::notification.title'),
            'slug.required' => trans('post::notification.slug'),
            'slug.unique' => trans('post::notification.slug_unique'),
        ];
    }
}
