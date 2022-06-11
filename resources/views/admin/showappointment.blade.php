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
                        <th style="padding:10px">Customer name</th>
                        <th style="padding:10px">Email</th>
                        <th style="padding:10px">Phone</th>
                        <th style="padding:10px">Doctor Name</th>
                        <th style="padding:10px">Date</th>
                        <th style="padding:10px">Message</th>
                        <th style="padding:10px">Status</th>

                        <th style="padding:10px">Approve</th>
                        <th style="padding:10px">Cancel</th>
                        <th style="padding:10px"><a href="{{url('print_admin')}}" target="_blank"class="btn btn-primary">Print PDF</a></th>
                        
                    </tr>
                    @foreach($data as $appoint)
                    <tr align="center" style="background-color:skyblue">
                        <td style="padding:10px">{{$appoint->name}}</td>
                        <td style="padding:10px">{{$appoint->email}}</td>
                        <td style="padding:10px">{{$appoint->phone}}</td>
                        <td style="padding:10px">{{$appoint->doctor}}</td>
                        <td style="padding:10px">{{$appoint->date}}</td>
                        <td style="padding:10px">{{$appoint->message}}</td>
                        <td style="padding:10px">{{$appoint->status}}</td>

                         @if($appoint->status=="In Progress")
                        <!-- if an admin click Approved button, it will gets specific id from database > appointment   -->
                        <td><a class="btn btn-success" href="{{url('approved', Crypt::encryptString($appoint->id))}}">Approved</a></td>

                        <!-- if an admin click Approved button, it will gets specific id from database > appointment   -->
                        <td><a class="btn btn-danger" href="{{url('canceled', Crypt::encryptString($appoint->id))}}">Canceled</a></td>
                        @endif
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                    @endforeach
                </table>
            </div>
        </div>    
        
        @include('admin.script')
  </body>
</html>