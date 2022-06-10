<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Medicine;

class PharmacistController extends Controller
{
    public function addview(){
        if(Auth::id())
        {
            if(Auth::user()->usertype==1)
            {
                $data=medicine::paginate(5);
                //send data to view
                return view('admin.medicine',compact('data'));        
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
