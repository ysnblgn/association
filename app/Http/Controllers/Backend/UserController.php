<?php

namespace App\Http\Controllers\Backend;

use App\Fee;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['user'] = User::all()->sortby('user_must');
        return view('backend.users.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $year=date('Y', strtotime(now()));
//        $month=date('m', strtotime(now()));
//        dd($month,$year);

        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:6'
        ]);


        if ($request->hasFile('user_file'))
        {
            $request->validate([
                'user_file'=>'required|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $file_name=uniqid().'.'.$request->user_file->getClientOriginalExtension();
            $request->user_file->move(public_path('images/users'),$file_name);
//            $request->settings_value=$file_name;
        } else {
            $file_name=null;
        }

        $user=User::create(
            [
                "name" => $request->name,
                "email" => $request->email,
                "user_file" => $file_name,
                "password" => Hash::make($request->password),
                "user_status" => $request->user_status,
                "user_role" => $request->user_role,

            ]
        );

        if ($user)
        {
            $year=date('Y', strtotime(now()));
            $month=date('m', strtotime(now()));
            for ($i=$month; $i<13; $i++){
                $fee=Fee::create([
                    'period_year'=>$year,
                    'period_month'=>$i,
                    'user_id'=>$user->id,
                    'paid_status'=>0

                ]);
            }

            return redirect(route('user.index'))->with('success','İşlem Başarılı');
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
        $users=User::where('id',$id)->first();
        $fees=Fee::where('user_id',$id)->get();
        return view('backend.users.edit',compact('users','fees'));
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
            'name'=>'required',
            'email'=>'required|email',
        ]);


        if ($request->hasFile('user_file'))
        {
            $request->validate([
                'user_file'=>'required|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $file_name=uniqid().'.'.$request->user_file->getClientOriginalExtension();
            $request->user_file->move(public_path('images/users'),$file_name);
            //            $request->settings_value=$file_name;

            if (strlen($request->password)>0)
            {
                $request->validate([
                    'password'=>'required|min:6'
                ]);

                $user=User::where('id',$id)->update(
                    [
                        "name" => $request->name,
                        "email" => $request->email,
                        "user_file" => $file_name,
                        "password" => Hash::make($request->password),
                        "user_status" => $request->user_status,
                        "user_role" => $request->user_role,


                    ]
                );
            }  else {

                $user=User::where('id',$id)->update(
                    [
                        "name" => $request->name,
                        "email" => $request->email,
                        "user_file" => $file_name,
                        "user_status" => $request->user_status,
                        "user_role" => $request->user_role,


                    ]
                );

            }



            $path='images/users/'.$request->old_file;
            if (file_exists($path))
            {
                @unlink(public_path($path));
            }
        } else {

            if (strlen($request->password)>0)
            {
                $request->validate([
                    'password'=>'required|min:6'
                ]);

                $user=User::where('id',$id)->update(
                    [
                        "name" => $request->name,
                        "email" => $request->email,
                        "password" => Hash::make($request->password),
                        "user_status" => $request->user_status,
                        "user_role" => $request->user_role,


                    ]
                );
            } else {

                $user=User::where('id',$id)->update(
                    [
                        "name" => $request->name,
                        "email" => $request->email,
                        "user_status" => $request->user_status,
                        "user_role" => $request->user_role,


                    ]
                );
            }
        }



        if ($user)
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
        $user=User::find(intval($id));
        if ($user->delete())
        {
            echo 1;
        }
        echo 0;
    }

    public function sortable(Request $request)
    {
        //        print_r($_POST['item']);

        foreach ($request->item as $key => $value)
        {
            $users=User::find(intval($value));
            $users->users_must=intval($key);
            $users->save();

        }
        echo true;

    }
}
