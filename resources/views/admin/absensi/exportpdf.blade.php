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
                <th>nama karyawan</th>
                <th>tanggal masuk</th>
                <th>waktu masuk</th>
                <th>status</th>
                <th>waktu keluar</th>
            </tr>
        </thead>
        @foreach ($absensi as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->namaKaryawan}}</td>
            <td>{{$item->tanggalMasuk}}</td>
            <td>{{$item->waktuMasuk}}</td>
            <td>{{$item->status}}</td>
            <td>{{$item->waktuKeluar}}</td>
        </tr>
        @endforeach
    </table>

</body>
</html>