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
                <th>description</th>
                <th>image</th>
                <th>price</th>
            </tr>
        </thead>
        @foreach ($menus as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->description}}</td>
            <td>{{$item->image}}</td>
            <td>{{$item->price}}</td>
        </tr>
        @endforeach
    </table>

</body>
</html>