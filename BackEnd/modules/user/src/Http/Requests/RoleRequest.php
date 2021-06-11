<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
                'title' => 'required|unique:user_roles,title,' . $this->id,
                'name' => 'required|unique:user_roles,name,' . $this->id
            ];
        }
        return [
            'title' => 'required|unique:user_roles,title',
            'name' => 'required|unique:user_roles,name'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => trans('user::role.title_required'),
            'title.unique' => trans('user::role.title_unique'),
            'name.required' => trans('user::role.name_required'),
            'name.unique' => trans('user::role.name_unique')
        ];
    }
}