<!DOCTYPE html>
<html lang="en">
<head>
    @include('user.head')
</head>
<body>
    @include('user.header')

    <div align="center" style="padding:70px;">
        <table>
            <tr style="background-color:black;">
                <th style="padding:10px; font-size:20px; color:white">Doctor Name</th>
                <th style="padding:10px; font-size:20px; color:white">Date</th>
                <th style="padding:10px; font-size:20px; color:white">Message</th>
                <th style="padding:10px; font-size:20px; color:white">Status</th>
                <th style="padding:10px; font-size:20px; color:white">Cancel Appointment</th>
            </tr>
            <!-- show the appointment -->
            @foreach($appoint as $appoints)
            <tr style="background-color:black;" align="center">
                <td style="padding:10px; font-size:20px; color:white">{{$appoints->doctor}}</td>
                <td style="padding:10px; font-size:20px; color:white">{{$appoints->date}}</td>
                <td style="padding:10px; font-size:20px; color:white">{{$appoints->message}}</td>
                <td style="padding:10px; font-size:20px; color:white">{{$appoints->status}}</td>
                <!-- delete specific appointment. send the id with this url to web.php -->
                <td><a class="btn btn-danger" onclick="return confirm('are you sure to delete this?')" href="{{url('cancel_appoint',$appoints->id)}}">Cancel</a></td>
            </tr>
            @endforeach
        </table>
    </div>

    @include('user.scripts')
</body>
</html>