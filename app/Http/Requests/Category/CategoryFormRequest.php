<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryFormRequest extends FormRequest
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
            'title' => 'required|unique:categories,title,except,id',
            'description' => 'required|min:30',
            'status' => 'required',
        ];
    }
    public function messages():array
    {
        return [
            'title.required' => 'Bạn chưa nhập tên danh mục phim',
            'title.unique' => 'Tên danh mục này đã tồn tại. Vui lòng kiểm tra lại!',
            'description.required' => 'Mô tả không dưới 30 ký tự',
            'status.required' => 'Trạng thái hiển thị danh mục'
        ];
    }
}
