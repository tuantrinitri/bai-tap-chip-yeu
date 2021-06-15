<?php

namespace Modules\Contact\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TopicRequest extends FormRequest
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
                'name' => 'required|unique:contact_topics,name,' . $this->id,
            ];
        }
        return [
            'name' => 'required|unique:contact_topics,name',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "Chưa nhập tên chủ đề",
            'name.unique' => "Tên chủ đề đã tồn tại",
        ];
    }
}
