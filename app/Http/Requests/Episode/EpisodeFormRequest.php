<?php

namespace App\Http\Requests\Episode;

use Illuminate\Foundation\Http\FormRequest;

class EpisodeFormRequest extends FormRequest
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
            'linkfilm' => 'required',
            'episode' => 'required',
            'movie_id' => 'required',
        ];
    }
    public function messages():array
    {
        return [
            'linkfilm.required' => 'Bạn chưa nhập linkflim',
            'episode.required' => 'Vui lòng chọn tập phim',
            'movie_id.required' => 'Vui lòng chọn phim cần xem'
        ];
    }
}
