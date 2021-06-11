<?php

namespace Modules\Menu\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
                'title' => 'required|max:255'
            ];
        }
        return [
            'title' => 'required|max:255'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Chưa nhập tên mục',
            'title.max' => 'Tên mục không vượt quá 255 ký tự'
        ];
    }
}
