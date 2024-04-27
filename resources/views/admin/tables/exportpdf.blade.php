<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pdf</title>
 <style>
     table {
            width: 100%;
           border-collapse: collapse;
        }

       table, td, th {
        border: 1px solid black;
        padding: 8px;
       }
 </style>

</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nama</th>
                <th>No Meja</th>
                <th>status</th>
                <th>lokasi</th>
            </tr>
        </thead>
        @foreach ($tables as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->guest_number}}</td>
            <td>{{$item->status}}</td>
            <td>{{$item->location}}</td>
        </tr>
        @endforeach
    </table>

</body>
</html>