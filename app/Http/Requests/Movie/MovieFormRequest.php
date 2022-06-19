<?php

namespace App\Http\Requests\Movie;

use Illuminate\Foundation\Http\FormRequest;

class MovieFormRequest extends FormRequest
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
            'subtitle' => 'required',
            'movie_duration' => 'required',
            'resolution' => 'required',
            'film_hot' => 'required',
            'name_eng' => 'required',
            'actor' => 'required',
            'director' => 'required',
            'description' => 'required|min:30',
            'belonging_movie' => 'required',
            'category_id' => 'required',
            'country_id' => 'required',
            'image' => 'required|mimes:jpeg,bmp,png,jpg',
            'status' => 'required',
            'year' => 'required',
        ];
    }
    public function messages() : array
    {
        return[
            'title.required'         => 'Vui lòng nhập tên phim bạn muốn thêm!',
            'subtitle.required'      => 'Vui lòng nhập phụ đề cho phim!',
            'movie_duration.required'=> 'Vui lòng nhập thời lượng cho phim!',
            'resolution.required'    => 'Vui lòng nhập chất lượng cho phim!',
            'film_hot.required'      => 'Hãy chọn chế độ hiển thị cho phim!',
            'name_eng.required'      => 'Bạn chưa nhập tên phim Tiếng Anh',
            'actor.required'         => 'Bạn chưa tên diễn viên',
            'director.required'      => 'Bạn chưa tên đạo diễn',
            'description.required'   => 'Mô tả phim là bắt buộc',
            'belonging_movie.required'=>    'Chọn loại phim',
            'category_id.required'   => 'Chọn danh mục phim',
            'country_id.required'    => 'Chọn quốc gia phim',
            'status.required'        => 'Trạng thái hiển thị phim',
            'image.required'         =>  'Vui lòng nhập hình ảnh!',
            'year.required'         =>  'Vui lòng nhập năm phát hành phim!'
        ];
    }
}
