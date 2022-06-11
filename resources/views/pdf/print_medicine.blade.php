<!DOCTYPE html>
<html lang="en">
  <head>
    <body>      
            <table>
                <tr style="background-color:skyblue">
                    <th style="padding:10px" >Medicine name</th>
                    <th style="padding:10px">Stock</th>
                    <th style="padding:10px">Description</th>
                    <th style="padding:10px">Created Date</th>
                    <th style="padding:10px">Expired Date</th>
                </tr>
                @foreach($data as $medicine)
                <tr align="center" style="background-color:skyblue">
                    <td style="padding:10px">{{$medicine->name}}</td>
                    <td style="padding:10px">{{$medicine->stock}}</td>
                    <td style="padding:10px">{{$medicine->description}}</td>
                    <td style="padding:10px">{{$medicine->created_at}}</td>
                    <td style="padding:10px">{{$medicine->expired}}</td>
                </tr>
                @endforeach
            </table>
   
        </body>
</html>