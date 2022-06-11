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

            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-bs-dismiss="alert">x</button>
                {{session()->get('message')}}
            </div>
            @endif            
                <table>
                    <tr style="background-color:black;">
                        <th style="padding:10px">Medicine name</th>
                        <th style="padding:10px">Stock</th>
                        <th style="padding:10px">Description</th>
                        <th style="padding:10px">Created Date</th>
                        <th style="padding:10px">Expired Date</th>
                        <th style="padding:10px"><a class="btn btn-success" href="{{url('add')}}">Add Medicine</a></th>
                        <th style="padding:10px"><a href="{{url('print_medicine')}}" target="_blank"class="btn btn-primary">Print PDF</a></th>

                    </tr>
                    @foreach($data as $medicine)
                    <tr align="center" style="background-color:skyblue">
                        <td style="padding:10px">{{$medicine->name}}</td>
                        <td style="padding:10px">{{$medicine->stock}}</td>
                        <td style="padding:10px">{{$medicine->description}}</td>
                        <td style="padding:10px">{{$medicine->created_at}}</td>
                        <td style="padding:10px">{{$medicine->expired}}</td>
                        <!-- if an admin click Approved button, it will gets specific id from database > appointment   -->
                        <td>
                          <div>
                        <!-- if an admin click Approved button, it will gets specific id from database > appointment   -->
                        <a class="btn btn-success" href="{{ route('edit', $medicine->id) }}">Edit</a>
                        <form action="{{ route('destroy', $medicine->id) }}" method="POST">
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