<?php

namespace App\Http\Controllers\Backend;

use App\Slider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['slider'] = Slider::all()->sortby('slider_must');
        return view('backend.sliders.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'slider_title'=>'required',
            'slider_content'=>'required',
            'slider_url'=>'active_url'
        ]);

        if (strlen($request->slider_slug)>3)
        {
            $slug=Str::slug($request->slider_slug);
        } else {
            $slug=Str::slug($request->slider_title);
        }

        if ($request->hasFile('slider_file'))
        {
            $request->validate([
                'slider_file'=>'required|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $file_name=uniqid().'.'.$request->slider_file->getClientOriginalExtension();
            $request->slider_file->move(public_path('images/sliders'),$file_name);
//            $request->settings_value=$file_name;
        } else {
            $file_name=null;
        }

        $slider=Slider::insert(
            [
                "slider_title" => $request->slider_title,
                "slider_slug" => $slug,
                "slider_file" => $file_name,
                "slider_url" => $request->slider_url,
                "slider_content" => $request->slider_content,
                "slider_status" => $request->slider_status,
            ]
        );

        if ($slider)
        {
            return redirect(route('slider.index'))->with('success','İşlem Başarılı');
        }
            return back()->with('error','İşlem Başarısız');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sliders=Slider::where('id',$id)->first();
        return view('backend.sliders.edit')->with('sliders',$sliders);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'slider_title'=>'required',
            'slider_content'=>'required',
            'slider_url'=>'active_url'
        ]);

        if (strlen($request->slider_slug)>3)
        {
            $slug=Str::slug($request->slider_slug);
        } else {
            $slug=Str::slug($request->slider_title);
        }

        if ($request->hasFile('slider_file'))
        {
            $request->validate([
                'slider_file'=>'required|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $file_name=uniqid().'.'.$request->slider_file->getClientOriginalExtension();
            $request->slider_file->move(public_path('images/sliders'),$file_name);
            //            $request->settings_value=$file_name;

            $slider=Slider::where('id',$id)->update(
                [
                    "slider_title" => $request->slider_title,
                    "slider_slug" => $slug,
                    "slider_file" => $file_name,
                    "slider_url" => $request->slider_url,
                    "slider_content" => $request->slider_content,
                    "slider_status" => $request->slider_status,
                ]
            );

            $path='images/sliders/'.$request->old_file;
            if (file_exists($path))
            {
                @unlink(public_path($path));
            }
        } else {
            $slider=Slider::where('id',$id)->update(
                [
                    "slider_title" => $request->slider_title,
                    "slider_slug" => $slug,
                    "slider_url" => $request->slider_url,
                    "slider_content" => $request->slider_content,
                    "slider_status" => $request->slider_status,
                ]
            );
        }



        if ($slider)
        {
            return back()->with('success','İşlem Başarılı');
        }
        return back()->with('error','İşlem Başarısız');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider=Slider::find(intval($id));
        if ($slider->delete())
        {
            echo 1;
        }
        echo 0;
    }

    public function sortable()
    {
        //        print_r($_POST['item']);

        foreach ($_POST['item'] as $key => $value)
        {
            $sliders=Slider::find(intval($value));
            $sliders->sliders_must=intval($key);
            $sliders->save();

        }
        echo true;

    }
}