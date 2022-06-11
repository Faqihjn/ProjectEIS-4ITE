<!DOCTYPE html>
<html lang="en">
  <head>
    <body>      
    <table>
            <tr style="background-color:black;">
                <th style="padding:10px; font-size:20px; color:white">Doctor Name</th>
                <th style="padding:10px; font-size:20px; color:white">Date</th>
                <th style="padding:10px; font-size:20px; color:white">Message</th>
                <th style="padding:10px; font-size:20px; color:white">Status</th>
            </tr>
            <!-- show the appointment -->
            @foreach($appoint as $appoints)
            <tr style="background-color:black;" align="center">
                <td style="padding:10px; font-size:20px; color:white">{{$appoints->doctor}}</td>
                <td style="padding:10px; font-size:20px; color:white">{{$appoints->date}}</td>
                <td style="padding:10px; font-size:20px; color:white">{{$appoints->message}}</td>
                <td style="padding:10px; font-size:20px; color:white">{{$appoints->status}}</td>
            </tr>
            @endforeach
        </table>

    </body>
</html>