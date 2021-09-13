<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Social; //sử dụng model Social
use Socialite; //sử dụng Socialite
use App\Login; //sử dụng model Login
use Session;
session_start();


class LoginController extends Controller
{
    public function login_facebook(){

        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook(){

        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
        if($account){
            //login in vao trang quan tri  
            $account_name = Login::where('customer_id',$account->user)->first();
            Session::put('customer_name',$account_name->customer_name);
 			Session::put('customer_id',$account_name->customer_id);
            return redirect('/checkout')->with('message', 'Đăng nhập Facebook thành công');
        }else{

            $hieu = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = Login::where('customer_email',$provider->getEmail())->first();

            if(!$orang){
                $orang = Login::create([
                    'customer_name' => $provider->getName(),
                    'customer_email' => $provider->getEmail(),
                    'customer_password' => '',
                    'customer_phone' => '',
                    

                ]);
            }
            $hieu->login()->associate($orang);
            $hieu->save();
            $account_name = Login::where('customer_id',$account->user)->first();
            Session::put('customer_name',$account_name->customer_name);
            Session::put('customer_id',$account_name->customer_id);          
            return redirect('/checkout')->with('message', 'Đăng nhập Facebook thành công');
        } 
    }

}
