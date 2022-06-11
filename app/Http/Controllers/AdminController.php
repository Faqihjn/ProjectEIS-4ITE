<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\Doctor;
use App\Models\Appointment;
use PDF;

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

    public function doctorview()
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype==2)
            {
                $data=doctor::paginate(5);
                //send data to view
                return view('admin.view_doctor',compact('data'));        
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

    public function edit_doctor($id)
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype==2)
            {
                $doctor = Doctor:: find($id);
                if(!$doctor){
                    return redirect()->back()->with('error', 'Doctor Not Found');
                }
                
                return view('admin.edit_doctor', compact('doctor'));        
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

    public function update_doctor(Request $request, $id)
    {
        $doctor = Doctor:: find($id);
       if(!$doctor){ 
        return redirect()->back()->with('error', 'Doctor Not Found');
       }
        
        $doctor->name= $request->name;
        $doctor->phone= $request->phone;
        $doctor->speciality= $request->speciality;
        $doctor->room= $request->room;
        $image=$request->file;
            if($request -> hasFile('file')){
                
                $path= 'doctorimage'.$doctor->image;
                if(File::exists($path)){
                    File::delete($path);
                }

            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->file->move('doctorimage',$imagename);
            $doctor->image=$imagename;
            }
        
        $doctor->update();
        return redirect()->to('/doctor_view')->with('message', 'Doctor Updated Successfully');
        
    }

    public function destroy_doctor($id)
    {
      $doctor = doctor:: find($id);
      $path= 'doctorimage'.$doctor->image;
      if(File::exists($path))
      {
        File::delete($path);
      }
      $doctor->delete();        
      return redirect()->to('/doctor_view')->with('message', 'Doctor Deleted Successfully');
    }
    

    public function print_doctor()
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype==2)
            {
                $data = Doctor::all();
                $pdf= PDF::loadView('pdf.print_doctor',compact('data'));          
                return $pdf->download('doctor.pdf');        
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

#########################################################################################################################    
# |     Admin                                            ^      Doctor Manajement                                       #
# v                                                      |                                                              # 
#########################################################################################################################
    
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
    
    public function print_admin()
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype==1)
            {
                $data = Appointment::all();
                $pdf= PDF::loadView('pdf.print_admin',compact('data'));          
                return $pdf->download('admin.pdf');        
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
   
}
