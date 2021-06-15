<?php

namespace Modules\Contact\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
                'title' => 'required'
            ];
        }
        return [
            'sender_name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'sender_name.required' => trans('contact::contact.name_required'),
        ];
    }
}
