<div class="sm:col-span-2">
    <select id="barang" name="barang" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-3xl focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
        <option selected="">Select Item</option>
        @foreach($barangs as $barang)
        <option value="{{$barang->id}}">{{$barang->nama_barang}}</option>
        @endforeach
    </select>
</div>