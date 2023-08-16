<?php
namespace App\Http\Controllers;
use Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
class GoogleController extends Controller
{
    public function signInwithGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callbackToGoogle()
    {
            try {
        
                $user = Socialite::driver('google')->user();
        
                $finduser = User::where('gauth_id', $user->id)->first();
        
                if($finduser){
        
                    Auth::login($finduser);
        
                    return redirect('/');
        
                }else{
                    $newUser = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'gauth_id'=> $user->id,
                        'gauth_type'=> 'google',
                        'password' => encrypt('admin@123')
                    ]);
        
                    Auth::login($newUser);
        
                    return redirect('/');
                }
        
            } catch (Exception $e) {
                dd($e->getMessage());
            }
        }
}