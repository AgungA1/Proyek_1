@extends('admin.layouts.main')

@section('content')
@if(session('success'))
<div class="flex justify-center fixed top-0 left-1/2 transform -translate-x-1/2 z-50 mt-6">
    <div id="toast-success" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Check icon</span>
        </div>
        <div class="ml-3 text-sm font-normal">{{ session('success') }}.</div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
    </div>
</div>
@elseif(session('error'))
<div class="flex justify-center fixed top-0 left-1/2 transform -translate-x-1/2 z-50 mt-6">
    <div id="toast-warning" class="flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-orange-500 bg-orange-100 rounded-lg dark:bg-orange-700 dark:text-orange-200">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Warning icon</span>
        </div>
        <div class="ml-3 text-sm font-normal">{{ session('error') }}</div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-warning" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
    </div>
</div>
@endif
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
        <div class="flex items-center pb-4 bg-white dark:bg-gray-900 m-5">
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text" id="search"
                    class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search for supplier" name="supplier">
            </div>
            <!-- Modal toggle -->
            <div class="flex justify-center m-5 ">
                <button id="defaultModalButton" data-modal-toggle="defaultModal"
                    class="block text-white bg-primary hover:bg-secondary focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                    type="button">

                    <div class="flex justify-center ">
                        <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Add Supplier
                    </div>
                </button>
            </div>

            <!-- Main modal -->
            <div id="defaultModal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                    <!-- Modal content -->
                    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                        <!-- Modal header -->
                        <div
                            class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-grey">
                                Add Supplier
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-toggle="defaultModal">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form action="{{ route('admin.create-supplier') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="grid gap-4 mb-4">
                                <div class="sm:col-span-2">
                                    <label for="nama_supplier"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Supplier</label>
                                    <input type="text" name="nama_supplier" id="nama_supplier"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Nama Supplier" required="">
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="no_telp_supplier"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No Telepon</label>
                                    <input type="text" name="no_telp_supplier" id="no_telp_supplier"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="No Telepon" required="">
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="alamat_supplier" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                                    <textarea id="alamat_supplier" name="alamat_supplier" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Alamat"></textarea>
                                </div>
                            </div>
                            <div class="space-x-2 border-t border-gray-200 rounded-b">
                                <div class="mt-5">
                                    <button type="submit"
                                        class="text-white inline-flex items-center bg-primary hover:bg-secondary focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                        <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Add Supplier
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-5">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center">
                            Id Supplier
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Nama Supplier
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            No Telepon
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Alamat Supplier
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @foreach ($suppliers as $supplier)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 text-center">
                                {{ $supplier->id }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $supplier->nama_supplier }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $supplier->no_telp_supplier }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $supplier->alamat_supplier }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-around">
                                    <!-- Modal toggle -->
                                    <div>
                                        <button id="updateKategoriButton-{{ $supplier->id }}" data-modal-toggle="updateKategoriModal-{{ $supplier->id }}"
                                            class="edit-button block text-white bg-primary hover:bg-secondary focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                            type="button">
                                            Edit Supplier
                                        </button>
                                    </div>

                                    <!-- Main modal -->
                                    <div id="updateKategoriModal-{{ $supplier->id }}" tabindex="-1" aria-hidden="true"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                            <!-- Modal content -->
                                            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                                <!-- Modal header -->
                                                <div
                                                    class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                        Edit Supplier
                                                    </h3>
                                                    <button type="button"
                                                        class="close-modal text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                        data-modal-toggle="updateKategoriModal-{{ $supplier->id }}">
                                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd"
                                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <form action="{{ route('admin.update-supplier', $supplier->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="grid gap-4 mb-4">
                                                        <div class="sm:col-span-2">
                                                            <label for="nama_supplier"
                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Supplier</label>
                                                            <input type="text" name="nama_supplier" id="nama_supplier" value="{{ $supplier->nama_supplier }}"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                                placeholder="Nama Kategori" required="">
                                                        </div>
                                                        <div class="sm:col-span-2">
                                                            <label for="no_telp_supplier"
                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No Telepon</label>
                                                            <input type="text" name="no_telp_supplier" id="no_telp_supplier" value="{{ $supplier->no_telp_supplier }}"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                                placeholder="No Telepon" required="">
                                                        </div>
                                                        <div class="sm:col-span-2">
                                                            <label for="alamat_supplier" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                                                            <textarea id="alamat_supplier" name="alamat_supplier" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Alamat">{{ $supplier->alamat_supplier }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="flex items-center space-x-4 border-t border-gray-200 rounded-b">
                                                        <div class="mt-4">
                                                            <button type="submit"
                                                                class="text-white inline-flex items-center bg-primary hover:bg-secondary focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                                                <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor"
                                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd"
                                                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                                        clip-rule="evenodd"></path>
                                                                </svg>
                                                                Update Supplier
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" id="deleteUserButton-{{ $supplier->id }}" data-modal-target="deleteUserModal" data-modal-toggle="deleteUserModal-{{ $supplier->id }}"
                                            class=" delete-button text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                            <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Delete Supplier
                                        </button>
                                    </div>

                                    <div id="deleteUserModal-{{ $supplier->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative w-full max-w-md max-h-full">
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <button type="button" class="close-modal absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="deleteUserModal-{{ $supplier->id }}">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                                <div class="p-6 text-center">
                                                    <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this supplier?</h3>
                                                    <div class="flex justify-center">
                                                        <form action="{{ route('admin.delete-supplier', $supplier->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button data-modal-toggle="deleteUserModal-{{ $supplier->id }}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                                Yes, I'm sure
                                                            </button>
                                                        </form>
                                                        <button data-modal-toggle="deleteUserModal-{{ $supplier->id }}" type="button" class="close-modal text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            {{$suppliers->links()}}
        </div>
    </div>
@endsection

@section('script')
    <script>
    
        setTimeout(function() {
                var toastElements = document.querySelectorAll('#toast-success, #toast-warning, #toast-danger');
                toastElements.forEach(function(element) {
                    if (element) {
                        element.remove();
                    }
                });
        }, 3000);

        //script untuk modal create data
        document.addEventListener("DOMContentLoaded", function(event) {
            document.getElementById('defaultModalButton').click();
        });

        //script for live search and activate form action
        $(document).ready(function() {
            var allRows = $('table tbody tr');
            var originalData = allRows.clone();

            $('#search').on('input', function() {
                var searchText = $(this).val().toLowerCase();
                var filteredRows = originalData.clone();

                filteredRows = filteredRows.filter(function() {
                    var rowText = $(this).text().toLowerCase();
                    return rowText.includes(searchText);
                });

                if (filteredRows.length > 0) {
                    $('table tbody').empty().append(filteredRows);
                    $('#tableBody').show();
                } else {
                    var noResultsRow = '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">';
                    noResultsRow += '<td colspan="5" class="px-6 py-4 text-center">No results found.</td>';
                    noResultsRow += '</tr>';
                    $('table tbody').empty().append(noResultsRow);
                    $('#tableBody').show();
                }

                activateActionButtons();
            });

            $('#search').on('keyup', function(event) {
                if (event.keyCode === 8 && $(this).val() === '') {
                    $('table tbody').empty().append(originalData);
                    $('#tableBody').show();
                    $('#noResults').hide();

                    activateActionButtons();
                }
            });

            function activateActionButtons() {
                $('.edit-button').on('click', function() {
                    var modalId = $(this).data('modal-toggle');
                    $('#' + modalId).toggleClass('hidden');
                });

                $('.delete-button').on('click', function() {
                    var modalId = $(this).data('modal-toggle');
                    $('#' + modalId).toggleClass('hidden');
                });

                const closeButtons = document.querySelectorAll('.close-modal');

                closeButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        const modalId = button.dataset.modalToggle;
                        const modal = document.getElementById(modalId);

                        modal.classList.add('hidden');
                    });
                })
            }
        });

    </script>
@endsection
