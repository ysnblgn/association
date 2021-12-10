<?php

namespace App\Http\Controllers\Frontend;

use App\Abouts;
use App\Activities;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
//        $about=Abouts::all()->sortBy('about_must');
//        return view('frontend.about.index',compact('about'));
    }
    public function detail($slug)
    {
        $data['about']=Abouts::all()->sortBy('about_must');

        $aboutList=Abouts::all()->sortBy('about_must');
        $about=Abouts::where('about_slug',$slug)->first();
        return view('frontend.about.detail',compact('data','aboutList','about'));
    }
}
