<?php

namespace App\Http\Controllers\Frontend;

use App\Abouts;
use App\Activities;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;


class ActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $data['about']=Abouts::all()->sortBy('about_must');
        $data['activity']=Activities::all()->sortBy('activity_must');
//        $user=User::find()
        return view('frontend.activity.index',compact('data'));
    }

    public function detail($slug)
    {
        $data['about']=Abouts::all()->sortBy('about_must');
        $data['activity']=Activities::all()->sortBy('activity_must');
        $activityList=Activities::all()->sortBy('activity_must');
        $activity=Activities::where('activity_slug',$slug)->first();
        return view('frontend.activity.detail',compact('activity','activityList','data'));
    }

}

//compact('data'));
