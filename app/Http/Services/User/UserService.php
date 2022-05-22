<?php
namespace App\Http\Services\User;

use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DB;


class UserService{
    public function update($request, $user)
    {
        try{
            $user -> fill( $request->input());
            $user->save();

            Session() -> flash('success', 'Cập nhật Slider thành công');

        }catch(\Exception $err)
        {
            Session() -> flash('error','Cập nhật Slider lỗi');

            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function delete($request)
    {
        $user = User::where('id', $request->input('id'))->first();
        if($user)
        {
            $path = str_replace('storage','public',$user->thumb);
            Storage::delete($path);
            $user->delete();
            return true;
        }
        return false;
    }
}