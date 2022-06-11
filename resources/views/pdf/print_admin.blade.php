<!DOCTYPE html>
<html lang="en">
  <head>
    <body>      
        <table>
            <tr style="background-color:skyblue;">
                <th style="padding:10px">Customer name</th>
                <th style="padding:10px">Email</th>
                <th style="padding:10px">Phone</th>
                <th style="padding:10px">Doctor Name</th>
                <th style="padding:10px">Date</th>
                <th style="padding:10px">Message</th>
                <th style="padding:10px">Status</th>
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
                </tr>
            @endforeach
        </table>

    </body>
</html>