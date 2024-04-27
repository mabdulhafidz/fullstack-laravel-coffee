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
                <th>menu id</th>
                <th>jumlah</th>
            </tr>
        </thead>
        @foreach ($stocks as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->menu_id}}</td>
            <td>{{$item->jumlah}}</td>
        </tr>
        @endforeach
    </table>

</body>
</html>