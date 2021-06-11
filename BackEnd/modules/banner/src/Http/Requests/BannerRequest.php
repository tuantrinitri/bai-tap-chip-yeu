<?php

namespace Modules\Banner\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
                'widget_id' => 'required'
            ];
        }
        return [
            'title' => 'required',
            'widget_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Chưa nhập tiêu đề',
            'widget_id.required' => 'Chưa chọn khu vực hiển thị'
        ];
    }
}
