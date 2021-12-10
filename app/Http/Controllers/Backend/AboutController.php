<?php

namespace App\Http\Controllers\Backend;

use App\Abouts;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['about'] = Abouts::all()->sortby('about_must');
        return view('backend.abouts.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.abouts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (strlen($request->about_slug)>3)
        {
            $slug=Str::slug($request->about_slug);
        } else {
            $slug=Str::slug($request->about_title);
        }

        if ($request->hasFile('about_file'))
        {
            $request->validate([
                'about_title'=>'required',
                'about_content'=>'required',
                'about_file'=>'required|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $file_name=uniqid().'.'.$request->about_file->getClientOriginalExtension();
            $request->about_file->move(public_path('images/abouts'),$file_name);
//            $request->settings_value=$file_name;
        } else {
            $file_name=null;
        }

        $about=Abouts::insert(
            [
                "about_title" => $request->about_title,
                "about_slug" => $slug,
                "about_file" => $file_name,
                "about_content" => $request->about_content,
                "about_status" => $request->about_status,
            ]
        );

        if ($about)
        {
            return redirect(route('about.index'))->with('success','İşlem Başarılı');
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
        $abouts=Abouts::where('id',$id)->first();
        return view('backend.abouts.edit')->with('abouts',$abouts);
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
        if (strlen($request->about_slug)>3)
        {
            $slug=Str::slug($request->about_slug);
        } else {
            $slug=Str::slug($request->about_title);
        }

        if ($request->hasFile('about_file'))
        {
            $request->validate([
                'about_title'=>'required',
                'about_content'=>'required',
                'about_file'=>'required|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $file_name=uniqid().'.'.$request->about_file->getClientOriginalExtension();
            $request->about_file->move(public_path('images/abouts'),$file_name);
            //            $request->settings_value=$file_name;

            $about=Abouts::where('id',$id)->update(
                [
                    "about_title" => $request->about_title,
                    "about_slug" => $slug,
                    "about_file" => $file_name,
                    "about_content" => $request->about_content,
                    "about_status" => $request->about_status,
                ]
            );

            $path='images/abouts/'.$request->old_file;
            if (file_exists($path))
            {
                @unlink(public_path($path));
            }
        } else {
            $about=Abouts::where('id',$id)->update(
                [
                    "about_title" => $request->about_title,
                    "about_slug" => $slug,
                    "about_content" => $request->about_content,
                    "about_status" => $request->about_status,
                ]
            );
        }



        if ($about)
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
        $about=Abouts::find(intval($id));
        if ($about->delete())
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
            $abouts=Abouts::find(intval($value));
            $abouts->abouts_must=intval($key);
            $abouts->save();

        }
        echo true;

    }

//    private function storeImage($customer)
//    {
//        if(request()->has('image')){
//            $customer->update([
//                'image' => request()->image->store('uploads','public'),
//            ]);
//
//
//
//            $image = Image::make(public_path('storage/' . $customer->image))->fit(300, 300);
//            $image->save();
//        }
//    }
}
