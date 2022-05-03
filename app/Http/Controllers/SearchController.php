<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
        public function getSearch(Request $request)
        {
            return view('admin.category.form');
        }
        function getSearchAjax(Request $request)
        {
            if($request->get('query'))
            {
                $query = $request->get('query');
                $data = DB::table('category')
                ->where('name_product', 'LIKE', "%{$query}%")
                ->get();
                $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
                foreach($data as $row)
                {
                $output .= '
                <li><a href="data/'. $row->id .'">'.$row->name_product.'</a></li>
                ';
            }
            $output .= '</ul>';
            echo $output;
        }
        }
}
