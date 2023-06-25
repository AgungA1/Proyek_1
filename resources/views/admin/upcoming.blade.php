@extends('admin.layouts.main')

@section('title', 'Upcoming Item Transfer')

@section('content')

<div class="flex flex-col">
    <h2 class="mb-2 text-l font-medium leading-none tracking-tight text-gray-900 md:text-xl dark:text-white">List of Upcoming Item Transfers</h2>
    <hr class="h-0.5 my-2 bg-black border-0 dark:bg-gray-700">

    <form class=" w-5/12 mt-6 mb-8 self-end" action="{{ route('admin.upcoming') }}" method="get" role="search">   
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
                    <th scope="col" class="px-3 py-3">
                        Request Type
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Quantity
                    </th>
                    <th scope="col" class="px-3 py-3">
                        Date
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $request)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        @if($request->kode_barang == null)
                            {{$request->nama_barang}}
                        @else
                            {{$request->barang->nama_barang}}
                        @endif
                    </th>
                    <td class="px-3 py-4">
                        {{$request->jenis_request}}
                    </td>
                    <td class="px-2 py-4">
                        @foreach($request->response as $response)
                            @if($response->kuantitas == null)
                                {{$response->gudang->nama_gudang}} : {{$request->kuantitas_barang}} <br>
                            @else
                                {{$response->gudang->nama_gudang}} : {{$response->kuantitas}} <br>
                            @endif
                        @endforeach
                    </td>
                    <td class="px-3 py-4">
                        {{$request->tanggal}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $requests->links() }}
    </div>
</div>
@endsection