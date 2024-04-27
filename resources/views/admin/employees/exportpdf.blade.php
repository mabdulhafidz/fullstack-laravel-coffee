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
                <th>nip</th>
                <th>nik</th>
                <th>nama</th>
                <th>jenis kelamin</th>
                <th>tempat lahir</th>
                <th>tanggal lahir</th>
                <th>telepon</th>
                <th>agama</th>
                <th>status nikah</th>
                <th>alamat</th>
                <th>image</th>




            </tr>
        </thead>
        @foreach ($employee as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->nip}}</td>
            <td>{{$item->nik}}</td>
            <td>{{$item->nama}}</td>
            <td>{{$item->jenis_kelamin}}</td>
            <td>{{$item->tempat_lahir}}</td>
            <td>{{$item->tanggal_lahir}}</td>
            <td>{{$item->telpon}}</td>
            <td>{{$item->agama}}</td>
            <td>{{$item->status_nikah}}</td>
            <td>{{$item->alamat}}</td>
            <td>{{$item->image}}</td>





        </tr>
        @endforeach
    </table>

</body>
</html>