<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan</title>
</head>
<body>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Barang</th>
                <th>Kode Barang</th>
                <th>ID Gudang</th>
                <th>Kuantitas Barang</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>{{$barangMasuk->id}}</td>
                    <td>{{$barangMasuk->barang->nama_barang}}</td>
                    <td>{{$barangMasuk->gudang->nama_gudang}}</td>
                    <td>{{$barangMasuk->kuantitas_barang}}</td>
                </tr>
        </tbody>
    </table>
</body>
</html>