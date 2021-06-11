<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
            'name' => 'required|max:191',
            'description' => 'max:191'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Chưa nhập tên phòng ban',
            'name.max' => 'Tên phòng ban không vượt quá 191 kí tự',
            'description.max' => 'Tên phòng ban không vượt quá 191 kí tự',
        ];
    }
}
