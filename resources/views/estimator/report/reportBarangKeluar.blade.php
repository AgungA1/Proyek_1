@extends('estimator.layouts.main')

@section('content')
<div class="text-3xl text-black font-semibold">
    REPORT BARANG KELUAR
</div>
<div class=" mt-10 relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    ID Gudang
                </th>
                <th scope="col" class="px-6 py-3">
                    Kode Barang
                </th>
                <th scope="col" class="px-6 py-3">
                    Kuantitas Barang
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangKeluar as $barang)
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$barang->id}}
                    </th>
                    <td class="px-6 py-4">
                        {{$barang->gudang->nama_gudang}}
                    </td>
                    <td class="px-6 py-4">
                        {{$barang->barang->nama_barang}}
                    </td>
                    <td class="px-6 py-4">
                        {{$barang->kuantitas_barang}}
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{route('estimator.cetakBarangKeluar', ['id' => $barang -> id])}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Cetak
                            Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$barangKeluar->links()}}
</div>
@endsection