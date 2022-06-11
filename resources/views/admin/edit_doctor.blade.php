<!DOCTYPE html>
<html lang="en">
  <head>
      <style>
          label
          {
            display: inline-block;
            width: 200px
          }
      </style>
@include('admin.css')    
  </head>
  <body>
    <div class="container-scroller">
      <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
          <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
            <div class="ps-lg-1">
              <div class="d-flex align-items-center justify-content-between">
                <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
                <a href="https://www.bootstrapdash.com/product/corona-free/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo" target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <a href="https://www.bootstrapdash.com/product/corona-free/"><i class="mdi mdi-home me-3 text-white"></i></a>
              <button id="bannerClose" class="btn border-0 p-0">
                <i class="mdi mdi-close text-white me-0"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      
        @include('admin.sidebar')

        @include('admin.navbar')

        <div class="container-fluid page-body-wrapper">   
            <div class="container" align="center" style="padding-top:100px;">
            
            <!-- message create doctor -->
            @if(session()->has('message'))

            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-bs-dismiss="alert">x</button>
                {{session()->get('message')}}
            </div>
            @endif
            @if(session()->has('message2'))

              <div class="alert alert-danger" role="alert">
              <button type="button" class="close" data-bs-dismiss="alert">x</button>
              {{session()->get('message2')}}
              </div>
            @endif    

            <form action="{{url('update_doctor',$doctor->id)}}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')
                    <div style="padding:15px;">
                        <label>Doctor Name</label>
                        <input value="{{ $doctor->name }}" type="text" style="color:black;" name="name" placeholder="Write the name">
                    </div>

                    <div style="padding:15px;">
                        <label>Phone</label>
                        <input value="{{ $doctor->phone }}" type="number" style="color:black;" name="phone" placeholder="Write the number">
                    </div>

                    <div style="padding:15px;">
                        <label>Speciality</label>
                        <select value="{{ $doctor->speciality }}" name="speciality" style="color:black; width: 200px">
                        <option >--Select--</option>
                            <option value="Cardiology">Cardiology</option>
                            <option value="Dental">Dental</option>
                            <option value="General Health">General Health</option>
                        </select>
                    </div>

                    <div style="padding:15px;">
                        <label>Room No</label>
                        <input value="{{ $doctor->room }}" type="text" style="color:black;" name="room" placeholder="Write the room number">
                    </div>

                    <div style="padding:15px;">
                        <label>Doctor Image</label>
                        <input type="file"  name="file">
                        <img width=100 height=100 src="doctorimage/{{$doctor->image}}" alt="">
                    </div>

                    <div style="padding:15px;">
                        <input type="submit" class="btn btn-success">
                    </div>

                </form>

            </div>
        </div>  
        
        @include('admin.script')
  </body>
</html>
