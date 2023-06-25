@extends('estimator.layouts.main')

@section('title', 'Request')

@section('content')
<script>
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

    function pending(){
        document.getElementById('pending_table').hidden = false;
        document.getElementById('underline-pending').hidden = false;
        document.getElementById('pending').style.display = 'grid';
        document.getElementById('responded_table').hidden = true;
        document.getElementById('underline-responded').hidden = true;
        document.getElementById('responded').style.display = 'none';
    }

    function responded(){
        document.getElementById('pending_table').hidden = true;
        document.getElementById('underline-pending').hidden = true;
        document.getElementById('pending').style.display = 'none';
        document.getElementById('responded_table').hidden = false;
        document.getElementById('underline-responded').hidden = false;
        document.getElementById('responded').style.display = 'grid';
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

    <h1 class="mb-2 -mt-1 text-3xl font-semibold leading-none tracking-tight text-gray-900 md:text-3xl dark:text-white">Item Request</h1>
    <hr class="h-0.5 my-4 bg-black border-0 dark:bg-gray-700">

    <form action="{{route('estimator.request.store')}}" method="post" class="flex flex-col w-10/12 ml-20">
        @csrf
        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
            <div class="sm:col-span-2">
                <label for="item" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Item</label>
                <div id="item"\ class="flex flex-wrap gap-12">
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
                @include('estimator.request.exist')
            </div>
            <div class="col-span-2" id="newForm" style="display: none;">
                @include('estimator.request.new')
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
            <input id="item_type" name="item_type" type="text" value="existing" hidden>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-10 mb-2 self-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Create Request
        </button>
    </form>

    <hr class="w-48 h-1 mx-auto mt-4 mb-2 bg-gray-300 border-0 rounded md:mt-10 md:mb-8 dark:bg-gray-700">

    <h2 class="mb-8 text-xl text-center font-semibold leading-none tracking-tight text-gray-900 md:text-xl dark:text-white">Request List</h2>

    <form class=" w-5/12 mb-8 self-end" action="{{ route('estimator.request.index') }}" method="get" role="search">   
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

    <div class="flex flex-row">
        <div class="flex flex-col">
            <button onclick="pending()" type="button" class="text-gray-900 ml-2 z-10 bg-transparent hover:underline hover:underline-offset-4 hover:decoration-4 hover:decoration-blue-800 focus:underline focus:underline-offset-4 focus:decoration-4 focus:decoration-blue-800 font-medium text-base px-5 py-2.5 mr-2 mb-2 dark:bg-transparent dark:hover:bg-blue-700 focus:outline-none">Pending Request</button>
            <hr id="underline-pending" class="-mt-5 self-center w-32 h-1 z-0 bg-blue-800 border-0 rounded dark:bg-blue-700">
        </div>
        <div class="flex flex-col">
            <button onclick="responded()" type="button" class="text-gray-900 ml-2 z-10 bg-transparent hover:underline hover:underline-offset-4 hover:decoration-4 hover:decoration-blue-800 focus:underline focus:underline-offset-4 focus:decoration-4 focus:decoration-blue-800 font-medium text-base px-5 py-2.5 mr-2 mb-2 dark:bg-transparent dark:hover:bg-blue-700 focus:outline-none">Responded Request</button>
            <hr id="underline-responded" hidden class="-mt-5 self-center w-36 h-1 z-0 bg-blue-800 border-0 rounded dark:bg-blue-700">
        </div>
    </div>
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
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Admin`s Response
                    </th>
                </tr>
            </thead>
            <tbody id="pending_table">
                @foreach($requests as $request)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$request->nama_barang}}
                    </th>
                    <td class="px-2 py-4">
                        {{$request->kuantitas_barang}}
                    </td>
                    <td class="px-6 py-4">
                        {{$request->tgl_pengadaan}}
                    </td>
                    <td class="px-6 py-4">
                        {{$request->status_request}}
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tbody id="responded_table" hidden>
                @foreach($responded_requests as $responded_request)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$responded_request->nama_barang}}
                    </th>
                    <td class="px-2 py-4">
                        {{$responded_request->kuantitas_barang}}
                    </td>
                    <td class="px-6 py-4">
                        {{$responded_request->tgl_pengadaan}}
                    </td>
                    <td class="px-6 py-4">
                        {{$responded_request->status_request}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div id="pending">
            {{ $requests->links() }}
        </div>
        <div id="responded" style="display: none;">
            {{ $responded_requests->links() }}
        </div>
</div>
@endsection