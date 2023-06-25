@extends('admin.layouts.main')

@section('title', 'Response')

@section('content')
<script>
    function accept(id_request){
        var persetujuan = document.getElementById('persetujuan');
        persetujuan.value = 'accept';

        document.getElementById('form-'+id_request).addEventListener('submit', function(event) {
        // Menghentikan aksi submit default agar dapat melakukan manipulasi form
        event.preventDefault();

        // Mendapatkan referensi elemen input yang akan dipindahkan
        var request = document.getElementById('id_request');

        // Mendapatkan referensi form
        var form = document.getElementById('form-'+id_request);

        // Memindahkan elemen input ke dalam form
        form.appendChild(persetujuan);

        // Melakukan submit form
        form.submit();
        });
    }

    function decline(id_request){
        var persetujuan = document.getElementById('persetujuan');
        persetujuan.value = 'decline';

        document.getElementById('form-'+id_request).addEventListener('submit', function(event) {
        // Menghentikan aksi submit default agar dapat melakukan manipulasi form
        event.preventDefault();

        // Mendapatkan referensi elemen input yang akan dipindahkan
        var persetujuan = document.getElementById('persetujuan');

        // Mendapatkan referensi form
        var form = document.getElementById('form-'+id_request);

        // Memindahkan elemen input ke dalam form
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

    <h2 class="mb-2 text-l font-medium leading-none tracking-tight text-gray-900 md:text-xl dark:text-white">List of Estimator Requests</h2>
    <hr class="h-0.5 my-2 bg-black border-0 dark:bg-gray-700">
    
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full mt-4 text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Item
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
                <input name="persetujuan" id="persetujuan" type="text" hidden value="">
                @foreach($requests as $request)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$request->nama_barang}}
                    </th>
                    <td class="px-2 py-4">
                        {{$request->kuantitas_barang}}
                    </td>
                    <td class="px-3 py-4">
                        {{$request->tgl_pengadaan}}
                    </td>
                    <form id="form-{{ $request->id }}" action="{{route('estimator.request.update', $request->id)}}" class="text-center" method="post">
                        @csrf
                        @method('PUT')
                        <td class="py-4 grid grid-cols-2 px-0">
                            <button form="form-{{ $request->id }}" type="submit" onclick="accept('{{$request->id}}')" class="font-medium text-green-600 dark:text-green-500 hover:underline text-center">
                                Accept
                            </button>
                            <button form="form-{{ $request->id }}" type="submit" onclick="decline('{{$request->id}}')" class="font-medium text-red-600 dark:text-red-500 hover:underline text-center">
                                Decline
                            </button>
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