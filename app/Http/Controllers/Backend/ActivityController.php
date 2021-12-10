<?php

namespace App\Http\Controllers\Backend;

use App\Activities;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['activity'] = Activities::all()->sortby('activity_must');
        return view('backend.activities.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.activities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (strlen($request->activity_slug)>3)
        {
            $slug=Str::slug($request->activity_slug);
        } else {
            $slug=Str::slug($request->activity_title);
        }

        if ($request->hasFile('activity_file'))
        {
            $request->validate([
                'activity_title'=>'required',
                'activity_content'=>'required',
                'activity_file'=>'required|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $file_name=uniqid().'.'.$request->activity_file->getClientOriginalExtension();
            $request->activity_file->move(public_path('images/activities'),$file_name);
//            $request->settings_value=$file_name;
        } else {
            $file_name=null;
        }

        $activity=Activities::insert(
            [
                "activity_title" => $request->activity_title,
                "activity_slug" => $slug,
                "activity_file" => $file_name,
                "activity_content" => $request->activity_content,
                "activity_status" => $request->activity_status,
            ]
        );

        if ($activity)
        {
            return redirect(route('activity.index'))->with('success','İşlem Başarılı');
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
        $activities=Activities::where('id',$id)->first();
        return view('backend.activities.edit')->with('activities',$activities);
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
        if (strlen($request->activity_slug)>3)
        {
            $slug=Str::slug($request->activity_slug);
        } else {
            $slug=Str::slug($request->activity_title);
        }

        if ($request->hasFile('activity_file'))
        {
            $request->validate([
                'activity_title'=>'required',
                'activity_content'=>'required',
                'activity_file'=>'required|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $file_name=uniqid().'.'.$request->activity_file->getClientOriginalExtension();
            $request->activity_file->move(public_path('images/activities'),$file_name);
            //            $request->settings_value=$file_name;

            $activity=Activities::where('id',$id)->update(
                [
                    "activity_title" => $request->activity_title,
                    "activity_slug" => $slug,
                    "activity_file" => $file_name,
                    "activity_content" => $request->activity_content,
                    "activity_status" => $request->activity_status,
                ]
            );

            $path='images/activities/'.$request->old_file;
            if (file_exists($path))
            {
                @unlink(public_path($path));
            }
        } else {
            $activity=Activities::where('id',$id)->update(
                [
                    "activity_title" => $request->activity_title,
                    "activity_slug" => $slug,
                    "activity_content" => $request->activity_content,
                    "activity_status" => $request->activity_status,
                ]
            );
        }



        if ($activity)
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
        $activity=Activities::find(intval($id));
        if ($activity->delete())
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
            $activities=Activities::find(intval($value));
            $activities->activities_must=intval($key);
            $activities->save();

        }
        echo true;

    }
}
