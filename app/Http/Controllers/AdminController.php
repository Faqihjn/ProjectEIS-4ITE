<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\Doctor;
use App\Models\Appointment;

class AdminController extends Controller
{
    public function addview(){
        if(Auth::id())
        {
            if(Auth::user()->usertype==2)
            {
                return view('admin.add_doctor');        
            }
            else{
                return redirect()->back();
            }
        }
        else
        {
            return redirect('login');
        }
    }

    public function upload(Request $request){
        $doctor=new doctor;
        $image=$request->file;
###Fix gagal kalo ga ada foto####
        if($request -> hasFile('file')){

        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->file->move('doctorimage',$imagename);

        $doctor->image=$imagename;
        $doctor->name=$request->name;
        $doctor->phone=$request->number;
        $doctor->room=$request->room;
        $doctor->speciality=$request->speciality;
        
        }else{
            $imagename ='';
            $doctor->image =$imagename;
            $doctor->name=$request->name;
            $doctor->phone=$request->number;
            $doctor->room=$request->room;
            $doctor->speciality=$request->speciality;
        
        }
        if($doctor->speciality=="--Select--")
        {

            $doctor->speciality=null;
            return redirect()->back()->with('message2', 'Select speciality');    
        }
       

        $doctor->save();

        return redirect()->back()->with('message', 'Doctor Added Successfully');
    }

    public function showappointment()
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype==1)
            {
                $data=appointment::paginate(5);
                //send data to view
                return view('admin.showappointment',compact('data'));        
            }
            else{
                return redirect()->back();
            }
        }
        else
        {
            return redirect('login');
        }

        // $data=appointment::all();
        // //send data to view
        // return view('admin.showappointment',compact('data'));
    }

    public function approved($id)
    {

        $decryptID = Crypt::decryptString($id);
        //find specific id from table appointment
        $data=appointment::find($decryptID);

        //change column's value from "in Progress" to "Approved"
        $data->status='Approved';

        $data->save();
        return redirect()->back()->with('message', 'Done !');  
        

        // //find specific id from table appointment
        // $data=appointment::find($id);

        // //change column's value from "in Progress" to "Approved"
        // $data->status='Approved';

        // $data->save();
        // return redirect()->back();
    }

    public function canceled($id)
    {
        $decryptID = Crypt::decryptString($id);
        //find specific id from table appointment
        $data=appointment::find($decryptID);

        //change column's value from "in Progress" to "Approved"
        $data->status='Canceled';

        $data->save();
        return redirect()->back()->with('message', 'Done !');

        // //find specific id from table appointment
        // $data=appointment::find($id);

        // //change column's value from "in Progress" to "Approved"
        // $data->status='Canceled';

        // $data->save();
        // return redirect()->back();
    }

   
}
