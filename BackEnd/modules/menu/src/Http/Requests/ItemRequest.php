<?php

namespace Modules\Menu\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'link' => 'required|max:191',
         ];
      }
      return [
         'link' => 'required|max:191',
      ];
   }
   public function messages()
   {
      return [
         'link.required' => 'Chưa nhập đường dẫn liên kết',
         'link.max' => 'Đường dẫn liên kết không được vượt quá 191 ký tự',
         'long_title.max' => 'Tiêu đề dài không được vượt quá 191 ký tự'
      ];
   }
}
