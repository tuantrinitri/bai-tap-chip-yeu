<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
        if ($this->has('type') && $this['type'] === 'first_user') {
            return [
                'display_name' => 'required',
                'email' => 'required|unique:users,email',
                'password' => 'required',
                'repassword' => 'required|same:password'
            ];
        }
        return [
            'email' => 'required',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'display_name.required' => trans('user::login.display_name_required'),
            'email.required' => trans('user::login.email_required'),
            'email.unique' => trans('user::login.email_unique'),
            'password.required' => trans('user::login.password_required'),
            'repassword.required' => trans('user::login.repassword_required'),
            'repassword.same' => trans('user::login.repassword_same')
        ];
    }
}