<?php

namespace App\Http\Controllers\Frontend;

use App\Abouts;
use App\Activities;
use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Slider;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DefaultController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function index()
    {
        $data['about']=Abouts::all()->sortBy('about_must');
        $data['activity']=Activities::all()->sortBy('activity_must');
        $data['slider']=Slider::all()->sortBy('slider_must');
        return view('frontend.default.index',compact('data'));
    }

    public function contact()
    {
//        $user = Auth::user();
//        if (!Auth::attempt()->$user->user_role == true){
//            return redirect()->intended(route('/login'));
//        }

        $data['about']=Abouts::all()->sortBy('about_must');

        return view('frontend.default.contact',compact('data'));

    }

    public function sendMail(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'message'=>'required',
        ]);

            $data=[
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'message'=>$request->message,
            ];

            Mail::to('test@test.com')->send(new SendMail($data)); //gönderilen mail adresi

            return back()->with('success',"Mail Başarıyla Gönderildi");
    }

//    public function login()
//    {
//        return view('login');
//    }
//
//    public function authenticate(Request $request)
//    {
//        $request->flash();
//
//        $credentials=$request->only('email','password');
//        $remember_me=$request->has('remember_me') ? true : false;
//        $user_role=User::all()->sortBy('user_role');
//
//        if (Auth::attempt($credentials,$remember_me))
//        {
//            return redirect()->intended(route('home.Index'));
//        }
//        elseif (Auth::all()->user_role=='üye')
////
//            return back()->with('error','deneme');
//
//        else {
//            return back()->with('error','Hatalı Kullanıcı');
//        }
//    }
////
//    public function logout()
//    {
//        Auth::logout();
//        return redirect(route('home.Index'))->with('success','Güvenli Çıkış Yapıldı');
//    }


}
