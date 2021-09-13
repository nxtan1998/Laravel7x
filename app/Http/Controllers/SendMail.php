<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Nexmo\Laravel\Facade\Nexmo;

class SendMail extends Controller
{
    public function sendmail(){
        $code = rand(1000,9999);
        $to_name = " Medical ";
        $to_email = 'dh51603403@student.stu.edu.vn';
        $data = array("name"=>'xuantan',"code"=>$code);
        Mail::send('pages.send_mail',$data,function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('Mã Xác Thực');
            $message->from($to_email,$to_name);
        });
       

    }

    // public function sms(){
        
    //     return view('pages.sms');

    // }
    // public function sendmail(Request $req){
            
    //         Nexmo::message()->send([
    //         'to'   => $req->mobile,
    //         'from' => '0977606160',
    //         'text' => 'Using the facade to send a message.'
    //     ]);

    // }
}
