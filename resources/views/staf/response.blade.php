@extends('staf.layouts.main')

@section('title', 'Response')

@section('content')
<script>
    function accept(id_request){
        var request = document.getElementById('id_request');
        request.value = id_request;
        var persetujuan = document.getElementById('persetujuan');
        persetujuan.value = 'accept';

        document.getElementById('form-'+id_request).addEventListener('submit', function(event) {
        // Menghentikan aksi submit default agar dapat melakukan manipulasi form
        event.preventDefault();

        // Mendapatkan referensi elemen input yang akan dipindahkan
        var request = document.getElementById('id_request');
        var gudang = document.getElementById('id_gudang');
        var persetujuan = document.getElementById('persetujuan');

        // Mendapatkan referensi form
        var form = document.getElementById('form-'+id_request);

        // Memindahkan elemen input ke dalam form
        form.appendChild(request);
        form.appendChild(gudang);
        form.appendChild(persetujuan);

        // Melakukan submit form
        form.submit();
        });
    }
    function partial(id_request){
        var request = document.getElementById('id_request');
        request.value = id_request;
        var persetujuan = document.getElementById('persetujuan');
        persetujuan.value = 'partial';

        document.getElementById('form-'+id_request).addEventListener('submit', function(event) {
        // Menghentikan aksi submit default agar dapat melakukan manipulasi form
        event.preventDefault();

        // Mendapatkan referensi elemen input yang akan dipindahkan
        var request = document.getElementById('id_request');
        var gudang = document.getElementById('id_gudang');
        var persetujuan = document.getElementById('persetujuan');

        // Mendapatkan referensi form
        var form = document.getElementById('form-'+id_request);

        // Memindahkan elemen input ke dalam form
        form.appendChild(request);
        form.appendChild(gudang);
        form.appendChild(persetujuan);

        // Melakukan submit form
        form.submit();
        });
    }
    function decline(id_request){
        var request = document.getElementById('id_request');
        request.value = id_request;
        var persetujuan = document.getElementById('persetujuan');
        persetujuan.value = 'decline';

        document.getElementById('form-'+id_request).addEventListener('submit', function(event) {
        // Menghentikan aksi submit default agar dapat melakukan manipulasi form
        event.preventDefault();

        // Mendapatkan referensi elemen input yang akan dipindahkan
        var request = document.getElementById('id_request');
        var gudang = document.getElementById('id_gudang');
        var persetujuan = document.getElementById('persetujuan');

        // Mendapatkan referensi form
        var form = document.getElementById('form-'+id_request);

        // Memindahkan elemen input ke dalam form
        form.appendChild(request);
        form.appendChild(gudang);
        form.appendChild(persetujuan);

        // Melakukan submit form
        form.submit();
        });
    }
</script>

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

    <h2 class="mb-2 text-l font-medium leading-none tracking-tight text-gray-900 md:text-xl dark:text-white">List of Admin Requests</h2>
    <hr class="h-0.5 my-2 bg-black border-0 dark:bg-gray-700">

    <form class=" w-5/12 mt-6 mb-8 self-end" action="{{ route('staf.response.index') }}" method="get" role="search">   
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
        <table class="w-full mt-4 text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Item
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Request Type
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Quantity
                    </th>
                    <th scope="col" class="px-3 py-3">
                        Date
                    </th>
                    <th scope="col" class="py-3 text-center">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <input name="id_request" id="id_request" type="text" hidden value="">
                <input name="id_gudang" id="id_gudang" type="text" hidden value="{{Auth::guard('staf_gudang')->user()->id_gudang}}">
                <input name="persetujuan" id="persetujuan" type="text" hidden value="">
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
                        {{$request->jenis_request}}
                    </td>
                    <td class="px-2 py-4">
                        {{$request->kuantitas_barang}}
                    </td>
                    <td class="px-3 py-4">
                        {{$request->tanggal}}
                    </td>
                    <form id="form-{{ $request->id }}" action="{{route('staf.response.store')}}" class="text-center" method="post">
                        @csrf
                        @method('POST')
                        <td class="py-4 grid grid-cols-3 px-0">
                            <button form="form-{{ $request->id }}" type="submit" onclick="accept('{{$request->id}}')" class="font-medium text-green-600 dark:text-green-500 hover:underline text-center">
                                Accept
                            </button>
                            <button data-modal-target="defaultModal{{$request->id}}" data-modal-toggle="defaultModal{{$request->id}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline text-center" type="button">
                                Accept Partially
                            </button>
                            <button form="form-{{ $request->id }}" type="submit" onclick="decline('{{$request->id}}')" class="font-medium text-red-600 dark:text-red-500 hover:underline text-center">
                                Decline
                            </button>
                            <div id="defaultModal{{$request->id}}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative w-full max-w-2xl max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                Accept Partially
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal{{$request->id}}">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-6 space-y-6">
                                            <div class="sm:col-span-2 ">
                                                <label for="kuantitas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
                                                <input type="number" name="kuantitas" id="kuantitas" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-3xl focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" min="1" placeholder="1">
                                            </div>
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                            <button form="form-{{$request->id}}" onclick="partial('{{$request->id}}')" data-modal-hide="defaultModal{{$request->id}}" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Send</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </form>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $requests->links() }}
    </div>
</div>
@endsection