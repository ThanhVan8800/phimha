<?php

namespace App\Http\Requests\Country;

use Illuminate\Foundation\Http\FormRequest;

class CountryFormRequest extends FormRequest
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
            'title' => 'required',
            // 'description' => 'required|min:30',
            'status' => 'required',
        ];
    }
    public function messages():array
    {
        return [
            'title.required' => 'Bạn chưa nhập tên quốc gia phim thuộc',
            'description.required' => 'Mô tả không dưới 30 ký tự',
            'status.required' => 'Trạng thái hiển thị quốc gia của phim'
        ];
    }
}
