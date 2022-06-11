<!DOCTYPE html>
<html lang="en">
  <head>
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
            <div align="center" style="padding-top: 100px">
            @if(session()->has('message'))
              <div class="alert alert-success" align="center" role="alert">
                <button type="button" class="close" data-db-dismiss="alert">x</button>
                  {{session()->get('message')}}
              </div>
            @endif
            
                <span>
                  {{$data->links()}}
                </span>

                <table>
                    <tr style="background-color:black;">
                        <th style="padding:10px">Doctor name</th>
                        <th style="padding:10px">Phone</th>
                        <th style="padding:10px">Speciality</th>
                        <th style="padding:10px">Room</th>
                        <th style="padding:10px">Image</th>
                        <th style="padding:10px">Action</th>
                        <th style="padding:10px"><a href="{{url('print_doctor')}}" target="_blank"class="btn btn-primary">Print PDF</a></th>
                                                
                    </tr>
                    @foreach($data as $doctors)
                    <tr align="center" style="background-color:skyblue">
                        <td style="padding:10px">{{$doctors->name}}</td>
                        <td style="padding:10px">{{$doctors->phone}}</td>
                        <td style="padding:10px">{{$doctors->speciality}}</td>
                        <td style="padding:10px">{{$doctors->room}}</td>
                        <td style="padding:10px"><img width=100 height=100 src="doctorimage/{{$doctors->image}}" alt=""></td>
                        <td>
                          <div>
                            <!-- if an admin click Approved button, it will gets specific id from database > appointment   -->
                                <a class="btn btn-success" href="{{ route('edit_doctor', $doctors->id) }}">Edit</a>
                                <form action="{{ route('destroy_doctor', $doctors->id) }}" method="POST">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger text-white">
                                        delete
                                    </button>
                                </form>
                            </div>
                        </td>
                      </tr>
                    @endforeach
                </table>
            </div>
        </div>    
        
        @include('admin.script')
  </body>
</html>