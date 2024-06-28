<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

use\App\Models\User;

use Exception;

class GoogleController extends Controller
{
    public function googlepage()
    {
        return Socialite::driver('google')->with(["prompt" => "select_account"])->redirect();
    }

    public function googlecallback()
        {
            try {
      
                $user = Socialite::driver('google')->user(); // mạng xã hội google
           
                $finduser = User::where('google_id', $user->id)->first(); //tìm kiếm xem tài khoản đã có db chưa
           
                if($finduser)
    
                {
           
                    Auth::login($finduser); //login lập tức
          
                    return redirect()->intended('/');
           
                }
    
                else
    
                {
                    $newUser = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'google_id'=> $user->id,
                        'password' => encrypt('123456dummy')// trên 8 kí tự
                    ]);
                    //login vào với acc mới
                    Auth::login($newUser);
          
                    return redirect()->intended('/');
                }
          
            } catch (Exception $e) {
                dd($e->getMessage());
            }
        }
    
}