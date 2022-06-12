<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Appointment;
use PDF;

class HomeController extends Controller
{
    public function redirect()
    {

        if(Auth::id())
        {
            if(Auth::user()->usertype=='0')
            {
                $doctor = doctor::all();
                return view('user.home',compact('doctor'));
            }
            else{
                return view('admin.home');
            }
        }

        else
        {
            return redirect() ->back();
        }

    }

    public function index()
    {
        if(Auth::id()){
        
            return redirect('home');
        } else{

            $doctor = doctor::all();
            return view('user.home',compact('doctor'));
        
        }
    }

    public function appointment(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'date' => 'required',
            'number' => 'required',
            'doctor' => 'required',
            'message' => 'required',
        ]);
        
        $data = new appointment;
        $data->name= $request->name;
            $data->email= $request->email;
            $data->date= $request->date;
            $data->phone= $request->number;
            $data->message= $request->message;
            $data->doctor= $request->doctor;
            $data->status='In Progress';
        if(Auth::id())
        {
        $data->user_id= Auth::user()->id;
        }

        if($data->doctor=="--- Select Doctor ---")
        {
            $data->doctor=null;
            return redirect()->back()->with('message2', 'Select a Doctor');    
        }
        $data->save();
        return redirect()->back()->with('message', 'Appointment Request Successful. We well contact with you soon');
        
        // $data = new appointment;
        // $data->name= $request->name;
        // $data->email= $request->email;
        // $data->date= $request->date;
        // $data->phone= $request->number;
        // $data->message= $request->message;
        // $data->doctor= $request->doctor;
        // $data->status='In Progress';

        // if(Auth::id())
        // {
        // $data->user_id= Auth::user()->id;
        // }

        // $data->save();
        // return redirect()->back()->with('message', 'Appointment Request Successful. We well contact with you soon');
    }

    public function myappointment()
    {
        
        if(Auth::id())
        {
            if(Auth::user()->usertype==0)
            {
           //specific id for appointment. the value takes from database user>id
           $userid=Auth::user ()->id;
           //get specific appointment for the specific user
           $appoint=appointment::where('user_id',$userid)->get();
            
           return view('user.my_appointment',compact('appoint'));
            }
        }
        else
        {
            return redirect()->back();
        }
        
        // //if id=true/logging in, return my_appointment. else return the same page
        // if(Auth::id())
        // {
        //    //specific id for appointment. the value takes from database user>id
        //    $userid=Auth::user ()->id;
        //    //get specific appointment for the specific user
        //    $appoint=appointment::where('user_id',$userid)->get();
        // return view('user.my_appointment',compact('appoint'));
        // }
        // else
        // {
        //     return redirect()->back();
        // }
    }

    public function cancel_appoint($id)
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype==0)
            {
                $decryptID = Crypt::decryptString($id);
            //find specific id from table appointment
                $data=appointment::find($decryptID);
        
                $data->delete();
                return redirect()->back();
            }
            else
            {
                return redirect()->back();
            }
        }

    }

    public function print_user()
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype==0)
            {
           //specific id for appointment. the value takes from database user>id
           $userid=Auth::user ()->id;
           //get specific appointment for the specific user
           $appoint=appointment::where('user_id',$userid)->get();
            
           $pdf= PDF::loadView('pdf.print_user',compact('appoint'));          
           return $pdf->download('appointment.pdf');
            }
        }
        else
        {
            return redirect()->back();
        }  
    }
}

