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
    display
</script>

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
    <hr class="h-0.5 my-8 bg-black border-0 dark:bg-gray-700">
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
</div>
@endsection