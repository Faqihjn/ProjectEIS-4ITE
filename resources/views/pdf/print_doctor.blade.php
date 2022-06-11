<!DOCTYPE html>
<html lang="en">
  <head>
    <body>      
        <table>
            <tr style="background-color:black;">
                <th style="padding:10px">Doctor name</th>
                <th style="padding:10px">Phone</th>
                <th style="padding:10px">Speciality</th>
                <th style="padding:10px">Room</th>
                                        
            </tr>
            @foreach($data as $doctors)
            <tr align="center" style="background-color:skyblue">
                <td style="padding:10px">{{$doctors->name}}</td>
                <td style="padding:10px">{{$doctors->phone}}</td>
                <td style="padding:10px">{{$doctors->speciality}}</td>
                <td style="padding:10px">{{$doctors->room}}</td>
                
                </tr>
            @endforeach
        </table>

    </body>
</html>