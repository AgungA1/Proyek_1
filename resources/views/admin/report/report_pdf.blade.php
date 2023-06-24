<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan</title>
    <style>
        .container {
            margin: 20px auto;
            padding: 20px;
            background-color: #f5f5f5;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 600px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container">
        <table class="table table-bordered">
            <th>
                <tr>
                    <th>ID Barang</th>
                    <th>Kode Barang</th>
                    <th>ID Gudang</th>
                    <th>Kuantitas Barang</th>
                </tr>
            </th>
            <tb>
                <tr>
                    <td>{{ $barangGudang->id }}</td>
                    <td>{{ $barangGudang->barang->nama_barang }}</td>
                    <td>{{ $barangGudang->gudang->nama_gudang }}</td>
                    <td>{{ $barangGudang->kuantitas_barang }}</td>
                </tr>
            </tb>
        </table>
    </div>
</body>
</html>
