<?php

namespace App\Http\Controllers\Backend;

use App\Fee;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    public function index()
    {
       $users=User::select('name','email','id')->get();

        return view('backend.fees.index',compact('users'));
    }

    public function save(Request $request)
    {
        $fee=Fee::create([
                        'period_year'=>$request->period_year,
                        'period_month'=>$request->period_month,
                        'user_id'=>$request->user_id,
                        'paid_status'=>$request->paid_status,
        ]);

        return back();
    }

    public function edit($id)
    {
        $user=User::where('id',$id)
                  ->with('fee')
                  ->first();

        return view('backend.fees.edit',compact('user'));
    }
    public function updated(Request $request,)
    {
        $fees=Fee::where('id',$request->id)->update(
            [
                "paid_status" => $request ->paid_status
            ]

        );
        if($fees)
        return response()
            ->json(['result'=>true,
                'message'=>'İşlem Başarılı'

                ]);
        return response()
            ->json(['result'=>false,
                'message'=>'İşlem Başarısız'

            ]);
    }

    public function getDetermine ()
    {
        return view('backend.fees.determine');
    }

    public function determine (Request $request)
    {

        $period_year=$request->period_year;
        $fees=Fee::whereBetween('period_month',[date('m', strtotime(now())),12])
                 ->where('period_year',$period_year)
                 ->get();
        foreach($fees as $fee)
        {
            Fee::where('id',$fee->id)->update(
                [
                    'determine_amount'=>$request->determine_amount
                ]
            );
        }

        return view('backend.fees.determine');

    }

//        return view('backend.fees.determine');
//    }


}
