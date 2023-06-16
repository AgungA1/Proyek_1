@extends('admin.layouts.main')

@section('title', 'Request')

@section('content')
<script>
    function takeaway() {
        var request = document.getElementById('request_type');
        request.value = 'Barang Keluar';
    }

    function putaway() {
        var request = document.getElementById('request_type');
        request.value = 'Barang Masuk';
        // console.log(request.value)
    }

    function existItem() {
        document.getElementById('existForm').style.display = 'grid';
        document.getElementById('newForm').style.display = 'none';

        var item = document.getElementById('item_type');
        item.value = 'existing';
    }

    function newItem() {
        document.getElementById('existForm').style.display = 'none';
        document.getElementById('newForm').style.display = 'grid';

        var item = document.getElementById('item_type');
        item.value = 'new';
    }
    
    function accept(){
        var item = document.getElementById('persetujuan_admin');
        item.value = 'accept';
    }
    
    function decline(){
        var item = document.getElementById('persetujuan_admin');
        item.value = 'decline';
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/datepicker.min.js"></script>

<div class="flex flex-col">
    <h2 class="mb-4 text-l font-medium leading-none tracking-tight text-gray-900 md:text-xl dark:text-white">Request Type</h2>
    <div class="flex flex-wrap gap-28 ml-8">
        <div class="flex items-center">
            <input onclick="takeaway()" checked id="takeaway" type="radio" value="" name="default-radio" class="w-4 h-4 text-blue-800 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="takeaway" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Takeaway Item</label>
        </div>
        <div class="flex items-center">
            <input onclick="putaway()" id="putaway" type="radio" value="" name="default-radio" class="w-4 h-4 text-blue-800 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="putaway" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Putaway Item</label>
        </div>
    </div>
    <hr class="h-0.5 my-6 bg-black border-0 dark:bg-gray-700">
    <form action="{{route('admin.request.store')}}" method="post" class="flex flex-col w-10/12 ml-20">
        @csrf
        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
            <div class="sm:col-span-2">
                <label for="item" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Item</label>
                <div id="item" class="flex flex-wrap gap-12">
                    <div class="flex items-center">
                        <input onclick="existItem()" checked id="exist" type="radio" value="" name="default-radio" class="w-4 h-4 text-blue-800 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="exist" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Existing Item</label>
                    </div>
                    <div class="flex items-center">
                        <input onclick="newItem()" id="new" type="radio" value="" name="default-radio" class="w-4 h-4 text-blue-800 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="new" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">New Item</label>
                    </div>
                </div>
            </div>
            <div class="col-span-2" id="existForm" style="display: grid;">
                @include('admin.request.existingForm')
            </div>
            <div class="col-span-2" id="newForm" style="display: none;">
                @include('admin.request.newForm')
            </div>
            <div class="sm:col-span-2">
                <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                </div>
                <input datepicker name="tanggal" id="tanggal" type="text" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-3xl focus:ring-blue-500 focus:border-blue-500 block w-full pl-3 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
            </div>
            <div class="sm:col-span-2 ">
                <label for="kuantitas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
                <input type="number" name="kuantitas" id="kuantitas" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-3xl focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" min="1" placeholder="1" required="">
            </div>
        </div>
        <input id="request_type" name="request_type" type="text" value="Barang Keluar" hidden>
        <input id="item_type" name="item_type" type="text" value="existing" hidden>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-10 mb-2 self-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Create Request
        </button>
    </form>

    <hr class="w-48 h-1 mx-auto mt-4 mb-2 bg-gray-300 border-0 rounded md:mt-10 md:mb-8 dark:bg-gray-700">

    <h2 class="mb-8 text-xl text-center font-semibold leading-none tracking-tight text-gray-900 md:text-xl dark:text-white">Request Type</h2>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Request`s Item
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Quantity
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Request Type
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Staff Response
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Accepted Quantity
                    </th>
                    <th scope="col" class="px-8 py-3">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $request)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <form action="{{ route('admin.request.update', $request->id) }}" method="post">
                    @csrf
                    @method('PUT')
                        <input name="persetujuan_admin" id="persetujuan_admin" type="text" hidden>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            @if($request->kode_barang == null)
                                {{$request->nama_barang}}
                            @else
                                {{$request->barang->nama_barang}}
                            @endif
                        </th>
                        <td class="px-2 py-4">
                            {{$request->kuantitas_barang}}
                        </td>
                        <td class="px-6 py-4">
                            {{$request->jenis_request}}
                        </td>
                        <td class="px-6 py-4">
                            {{$request->tanggal}}
                        </td>
                        <td class="px-6 py-4">
                            {{$request->status_persetujuan}}
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $responses = $request->gudang()->wherePivot('persetujuan', 'partial')->orderBy('kuantitas', 'DESC')->get();
                            @endphp
                            @if($request->status_persetujuan == 'ditolak')
                                -
                            @elseif($request->status_persetujuan == 'diterima sebagian')
                                @foreach($request->gudang as $gudang)
                                    @if($gudang->pivot->persetujuan == 'partial')
                                        {{$gudang->nama_gudang}} : {{$gudang->pivot->kuantitas}}
                                        @break
                                    @endif
                                @endforeach
                            @elseif($request->status_persetujuan == 'gabungan utuh')
                                @php
                                    $total = 0;
                                    $i = 0;
                                @endphp
                                @foreach($responses as $response)
                                    @php
                                        $total += $response->pivot->kuantitas;
                                        $i++;
                                    @endphp
                                    @if($total > $request->kuantitas_barang)
                                        @php
                                            $sisa = $response->pivot->kuantitas + ($request->kuantitas_barang - $total);
                                        @endphp
                                        {{$response->nama_gudang}} : {{$sisa}} <br>
                                        @break
                                    @endif
                                    @if($total == $request->kuantitas_barang)
                                        {{$response->nama_gudang}} : {{$response->pivot->kuantitas}} <br>
                                        @break
                                    @endif
                                    {{$response->nama_gudang}} : {{$response->pivot->kuantitas}} <br>
                                @endforeach
                            @elseif($request->status_persetujuan == 'gabungan tidak utuh')
                                @foreach($responses as $response)
                                    {{$response->nama_gudang}} : {{$response->pivot->kuantitas}}
                                @endforeach
                            @elseif($request->status_persetujuan == 'diterima')
                                @foreach($request->gudang as $gudang)
                                    @if($gudang->pivot->persetujuan == 'accept')
                                        {{$gudang->nama_gudang}} : {{$request->kuantitas_barang}}
                                        @break
                                    @endif
                                @endforeach
                            @endif
                        </td>
                        <td class="py-6 grid grid-cols-2">
                            <button type="submit" onclick="accept()" class="font-medium text-green-600 dark:text-green-500 hover:underline text-center">
                                Accept
                            </button>
                            <button type="submit" onclick="decline()" class="font-medium text-red-600 dark:text-red-500 hover:underline text-center">
                                Decline
                            </button>
                        </td>
                    </form>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
</div>
@endsection