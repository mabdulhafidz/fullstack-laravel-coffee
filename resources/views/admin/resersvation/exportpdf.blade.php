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
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Telp</th>
                <th>Date</th>
                <th>Table Id</th>
                <th>Nomor Meja</th>
            </tr>
        </thead>
        @foreach ($resersvation as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->first_name}}</td>
            <td>{{$item->last_name}}</td>
            <td>{{$item->email}}</td>
            <td>{{$item->tel_number}}</td>
            <td>{{$item->res_date}}</td>
            <td>{{$item->table_id}}</td>
            <td>{{$item->guest_number}}</td>
        </tr>
        @endforeach
    </table>

</body>
</html>