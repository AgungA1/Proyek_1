@extends('admin.layouts.main')

@section('title', 'Request')

@section('content')
<script>
    function takeaway() {
        document.getElementById('existForm').style.display = 'grid';
        document.getElementById('newForm').style.display = 'none';
        document.getElementById('item').style.display = 'none';

        var item = document.getElementById('item_type');
        item.value = 'existing';
        var request = document.getElementById('request_type');
        request.value = 'Barang Keluar';
    }

    function putaway() {
        document.getElementById('item').style.display = 'flex';

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

    function accept(id_request) {
        var persetujuan = document.getElementById('persetujuan_admin');
        persetujuan.value = 'accept';

        document.getElementById('form-' + id_request).addEventListener('submit', function(event) {
            // Menghentikan aksi submit default agar dapat melakukan manipulasi form
            event.preventDefault();

            // Mendapatkan referensi elemen input yang akan dipindahkan
            var pesetujuan = document.getElementById('persetujuan_admin');

            // Mendapatkan referensi form
            var form = document.getElementById('form-' + id_request);

            // Memindahkan elemen input ke dalam form
            form.appendChild(persetujuan);

            // Melakukan submit form
            form.submit();
        });
    }

    function decline(id_request) {
        var persetujuan = document.getElementById('persetujuan_admin');
        persetujuan.value = 'decline';

        document.getElementById('form-' + id_request).addEventListener('submit', function(event) {
            // Menghentikan aksi submit default agar dapat melakukan manipulasi form
            event.preventDefault();

            // Mendapatkan referensi elemen input yang akan dipindahkan
            var pesetujuan = document.getElementById('persetujuan_admin');

            // Mendapatkan referensi form
            var form = document.getElementById('form-' + id_request);

            // Memindahkan elemen input ke dalam form
            form.appendChild(persetujuan);

            // Melakukan submit form
            form.submit();
        });
    }

    function hapus(id_request) {
        var persetujuan = document.getElementById('persetujuan_admin');
        persetujuan.value = 'delete';

        document.getElementById('form-' + id_request).addEventListener('submit', function(event) {
            // Menghentikan aksi submit default agar dapat melakukan manipulasi form
            event.preventDefault();

            // Mendapatkan referensi elemen input yang akan dipindahkan
            var pesetujuan = document.getElementById('persetujuan_admin');

            // Mendapatkan referensi form
            var form = document.getElementById('form-' + id_request);

            // Memindahkan elemen input ke dalam form
            form.appendChild(persetujuan);

            // Melakukan submit form
            form.submit();
        });
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/datepicker.min.js"></script>

<div class="flex flex-col relative">
    @if ($positive_message = Session::get('positive'))
    <div id="toast-success" class="flex absolute self-center items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg drop-shadow-2xl dark:text-gray-400 dark:bg-gray-800" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Check icon</span>
        </div>
        <div class="ml-3 text-sm font-normal">{{ $positive_message }}</div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>
    @endif

    @if ($delete_message = Session::get('delete'))
    <div id="toast-danger" class="flex absolute self-center items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg drop-shadow-2xl dark:text-gray-400 dark:bg-gray-800" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Error icon</span>
        </div>
        <div class="ml-3 text-sm font-normal">{{$delete_message}}</div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-danger" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>
    @endif

    <h1 class="mb-6 -mt-2 text-3xl font-semibold leading-none tracking-tight text-gray-900 md:text-3xl dark:text-white">Item Request</h1>
    <div class="mb-4 text-base font-medium leading-none tracking-tight text-gray-900 md:text-base dark:text-white">Request Type</div>
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
                <div id="item" style="display: none;" class="flex flex-wrap gap-12">
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
            <div class="sm:col-span-2 relative">
                <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                <div class="absolute inset-y-0 left-0 flex items-center mt-6 pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input datepicker name="tanggal" id="tanggal" type="text" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-3xl focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
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

    <h2 class="mb-8 text-xl text-center font-semibold leading-none tracking-tight text-gray-900 md:text-xl dark:text-white">Request List</h2>
    
    <form class=" w-5/12 mb-8 self-end" action="{{ route('admin.request.index') }}" method="get" role="search">   
        @csrf
        @method('GET')
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input type="search" id="keyword" name="keyword" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Type, Status,...">
            <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
        </div>
    </form>

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
                <input name="persetujuan_admin" id="persetujuan_admin" type="text" value="" hidden>
                @foreach($requests as $request)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
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
                    <td>
                        <form class="py-6 grid grid-cols-2" id="form-{{$request->id}}" action="{{ route('admin.request.update', $request->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            @if($request->status_persetujuan == 'ditolak')
                            <button data-modal-target="delete-{{$request->id}}" data-modal-toggle="delete-{{$request->id}}" class="col-span-2 font-medium text-red-600 dark:text-red-500 hover:underline text-center" type="button">
                                Delete
                            </button>
                            @elseif($request->status_persetujuan != 'pending')
                            <button form="form-{{$request->id}}" type="submit" onclick="accept('{{$request->id}}')" class="font-medium text-green-600 dark:text-green-500 hover:underline text-center">
                                Accept
                            </button>
                            <button form="form-{{$request->id}}" type="submit" onclick="decline('{{$request->id}}')" class="font-medium text-red-600 dark:text-red-500 hover:underline text-center">
                                Decline
                            </button>
                            @endif
                            <div id="delete-{{$request->id}}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="delete-{{$request->id}}">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-6 text-center">
                                            <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this request?</h3>
                                            <button form="form-{{$request->id}}" data-modal-hide="delete-{{$request->id}}" type="submit" onclick="hapus('{{$request->id}}')" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                Yes, I'm sure
                                            </button>
                                            <button data-modal-hide="delete-{{$request->id}}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $requests->links() }}
    </div>

</div>
@endsection