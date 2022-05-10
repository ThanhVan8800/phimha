<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
        //Tìm kiếm cho danh mục
        public function search(Request $request)
            {
                $output = '';
                $cate_search = Category::where('title','LIKE','%'.$request->keyword.'%')->get();
                $cate_search1 = Category::where('description','LIKE','%'.$request->keyword.'%')->get();

                foreach($cate_search as $cate){
                        $output .= '
                                        <tr id="'.$cate->id.'">
                                                    <th scope="row">'.$cate->id.' </th>
                                                    <td>'. $cate->title .'</td>
                                                    <td>'. $cate->description .'</td>
                                                    <td>'. $cate->slug .'</td>
                                                    <td>'. $cate->status .'</td>
                                                    <td>
                                                        <label>
                                                            <form method="POST" action="'.route('category.destroy',$cate->id).'" onsubmit = "return confirm("Bạn có muốn xóa?")">
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <input type="hidden" name="_token" value="'. csrf_token() .'" />
                                                                <button class="btn btn-dark btn-sm" style = "height:40px; width:40px">
                                                                                <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <a href="'.route('category.edit', $cate->id).'" class="btn btn-warning" style = "height:40px; width:40px"><i class="fa-solid fa-pen"></i></a>
                                                    </td>
                                        </tr>';
                    }
                    foreach($cate_search1 as $cate){
                        $output .= '
                                        <tr id="'.$cate->id.'">
                                                    <th scope="row">'.$cate->id.' </th>
                                                    <td>'. $cate->title .'</td>
                                                    <td>'. $cate->description .'</td>
                                                    <td>'. $cate->slug .'</td>
                                                    <td>'. $cate->status .'</td>
                                                    <td>
                                                        <form method="DELETE" action="'.route('category.destroy',$cate->id).'" onsubmit = "return confirm("Bạn có muốn xóa?")>
                                                            @csrf
                                                            <button type="submit" class="btn btn-dark btn-sm" style = "height:40px; width:40px">
                                                                            <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <a href="'.route('category.edit', $cate->id).'" class="btn btn-warning" style = "height:40px; width:40px"><i class="fa-solid fa-pen"></i></a>
                                                    </td>
                                        </tr>';
                    }
                        return response()->json($output);
                                                    
                                                    // '. Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-dark btn-sm', 'style' => 'height:40px; width:40px'] )  .'
            }
}
