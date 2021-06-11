<?php

namespace Modules\Widget\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WidgetRequest extends FormRequest
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
                'module' => 'required',
                'name' => 'required',
                'group' => 'required',
            ];
        }

        return [
            'title' => 'required',
            'module' => 'required',
            'name' => 'required',
            'group' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Chưa nhập tiêu đề',
            'module.required' => 'Chưa nhập module',
            'name.required' => 'Chưa nhập tên',
            'group.required' => 'Chưa nhập vị trí',
        ];
    }
}
