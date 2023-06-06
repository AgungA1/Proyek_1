<div class="sm:col-span-2 mb-4">
    <label for="kategori" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Item Category</label>
    <select id="kategori" name="kategori" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-3xl focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
        <option selected="">Select category</option>
        @foreach($kategoris as $kategori)
        <option value="{{$kategori->id}}">{{$kategori->nama_kategori}}</option>
        @endforeach
    </select>
</div>
<div class="sm:col-span-2">
    <label for="nama_barang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Item Name</label>
    <input type="text" name="nama_barang" id="nama_barang" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-3xl focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type item name">
</div>
