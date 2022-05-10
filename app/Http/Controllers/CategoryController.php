<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Genre;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lstCate = Category::orderBy('position','ASC')->get();
        // asc tăng dần 
        return view('admin.category.form',[
            'lstCate' => $lstCate,
            'title' => 'Danh mục phim'
        ]);
        // có thể dùng compact tương tự
        // return view('admin.category.form',compact('lstCate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $data = $request->all();
            $category = new Category();
            $category -> title = $data['title'];
            $category -> slug = $data['slug'];
            $category -> description = $data['description'];
            $category -> status = $data['status'];
            $category -> save();
            Session::flash('success','Thêm danh mục phim thành công');
        }catch(Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return redirect()-> back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $lstCate = Category::all();
        return view('admin.category.form',compact( 'id','lstCate','category'),[
            'title'=>'Chỉnh sửa phim theo danh mục',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $data = $request->all();
            $category =  Category::find($id);
            $category -> title = $data['title'];
            $category -> slug = $data['slug'];
            $category -> description = $data['description'];
            $category -> status = $data['status'];
            $category -> save();
            Session::flash('success','Cập nhật danh mục phim thành công');
        }catch(Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        
        return Redirect::route('category.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->back();
    }
    public function resorting(Request  $request)
    {
        $data = $request->all();//[1,2,3,3]
        foreach($data['array_id'] as $key => $value){
            //[0=>1]
            //[1=>2]
            //[2=>3]
            //[3=>3]
            $category = Category::find($value);
            $category->position = $key;
            $category->save();
        }
    }
    public function search(Request $request)
    {
        $output = '';
        $cate_search = Category::where('title','LIKE','%'.$request->keyword.'%')->get();
        $cate_search1 = Category::where('description','LIKE','%'.$request->keyword.'%')->get();
        $genre_search = Genre::where('title','LIKE','%'.$request->keyword.'%')->get();
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
            foreach($genre_search as $genre){
                $output .= '
                                <tr id="'.$genre->id.'">
                                            <th scope="row">'.$genre->id.' </th>
                                            <td>'. $genre->title .'</td>
                                            <td>'. $genre->description .'</td>
                                            <td>'. $genre->slug .'</td>
                                            <td>'. $genre->status .'</td>
                                            <td>
                                                <label>
                                                    <form method="POST" action="'.route('genre.destroy',$genre->id).'" onsubmit = "return confirm("Bạn có muốn xóa?")">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="'. csrf_token() .'" />
                                                        <button class="btn btn-dark btn-sm" style = "height:40px; width:40px">
                                                                        <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </label>
                                            </td>
                                            <td>
                                                <a href="'.route('genre.edit', $genre->id).'" class="btn btn-warning" style = "height:40px; width:40px"><i class="fa-solid fa-pen"></i></a>
                                            </td>
                                </tr>';
            }
                return response()->json($output);
                                            
                                            // '. Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-dark btn-sm', 'style' => 'height:40px; width:40px'] )  .'
    }
}
