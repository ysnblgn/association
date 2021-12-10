<?php

namespace App\Http\Controllers\Frontend;


use App\Abouts;
use App\Activities;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;


class FeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $data['about']=Abouts::all()->sortBy('about_must');
        $data['activity']=Activities::all()->sortBy('activity_must');
        $user=User::where('id',$id)->with('fee')->first();

        return view('frontend.fee.index',compact('user','data'));
    }

//    public function detail($slug)
//    {
//        $data['about']=Abouts::all()->sortBy('about_must');
//        $data['activity']=Activities::all()->sortBy('activity_must');
//        $activityList=Activities::all()->sortBy('activity_must');
//        $activity=Activities::where('activity_slug',$slug)->first();
//        return view('frontend.activity.detail',compact('activity','activityList','data'));
//    }

}

//compact('data'));
