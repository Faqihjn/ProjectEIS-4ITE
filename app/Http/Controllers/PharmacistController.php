<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Medicine;
use PDF;

class PharmacistController extends Controller
{
    public function addview(){
        if(Auth::id())
        {
            if(Auth::user()->usertype==3)
            {
                $data=medicine::paginate(5);
                //send data to view
                return view('pharma.medicine',compact('data'));        
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

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'stock' => 'required',
            'expired' => 'required',
        ]);
        
        $data = new medicine;
        $data->name= $request->name;
            $data->stock= $request->stock;
            $data->description= $request->description;
            $data->created_at= $request->created_at;
            $data->expired= $request->expired;
        
        $data->save();
        return redirect()->back()->with('message', 'Medicine Added Successfully');
        
    }
    
    public function add()
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype==3)
            {
                return view('pharma.add_medicine');        
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

    public function edit($id)
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype==3)
            {
                $data = medicine:: find($id);
                if(!$data){
                    return redirect()->back()->with('error', 'Medicine Data Not Found');
                }
                
                return view('pharma.edit_medicine', compact('data'));        
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

    public function update(Request $request, $id)
    {
        $data = Medicine:: find($id);
       if(!$data){
        return redirect()->back()->with('error', 'Medicine Data Not Found');
       }
        
        $data->name= $request->name;
            $data->stock= $request->stock;
            $data->description= $request->description;
            $data->created_at= $request->created_at;
            $data->expired= $request->expired;
        
        $data->save();
        return redirect()->to('/medicine')->with('message', 'Medicine Updated Successfully');
        
    }

    public function destroy($id)
    {
      $data = medicine:: find($id);
      $data->delete();        
      return redirect()->to('/medicine')->with('message', 'Medicine Deleted Successfully');
    }
    

    public function print_medicine()
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype==3)
            {
                $data = Medicine::all();
                $pdf= PDF::loadView('pdf.print_medicine',compact('data'));          
                return $pdf->download('medicine.pdf');        
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
