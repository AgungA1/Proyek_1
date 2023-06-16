@extends('admin.layouts.main')

@section('content')
    <div class="text-3xl text-black font-semibold">
        DASHBOARD   
    </div>
    <div class="text-l text-black">
        Welcome Back, {{ Auth::guard('admin')->user()->nama }}
    </div>
    {{-- Card Info, Href ke view lain --}}
    <div class="grid gap-10 mt-5 grid-cols-4">
        <a href="#"
            class="block max-w-sm p-6 bg-blue-100 border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <div class="flex">
                <div class="pt-5"><i class="fa-solid fa-warehouse fa-2xl" style="color: #000000;"></i></div>
                <div class="pl-6">
                    <h5 class="mb-2 tracking-tight text-gray-500 dark:text-white">Jumlah Gudang</h5>
                    <p class="text-2xl font-bold text-gray-700 dark:text-gray-400">{{ $gudangs }}</p>
                </div>
            </div>
        </a>
        <a href="#"
            class="block max-w-sm p-6 bg-blue-100 border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <div class="flex">
                <div class="pt-5"><i class="fa-solid fa-users fa-2xl" style="color: #000000;"></i></div>
                <div class="pl-6">
                    <h5 class="mb-2 tracking-tight text-gray-500 dark:text-white">Jumlah Staff</h5>
                    <p class="text-2xl font-bold text-gray-700 dark:text-gray-400">{{ $stafs }}</p>
                </div>
            </div>
        </a>
        <a href="#"
            class="block max-w-sm p-6 bg-blue-100 border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <div class="flex">
                <div class="pt-5"><i class="fa-solid fa-calculator fa-2xl" style="color: #000000;"></i></div>
                <div class="pl-6">
                    <h5 class="mb-2 tracking-tight text-gray-500 dark:text-white">Jumlah Estimator</h5>
                    <p class="text-2xl font-bold text-gray-700 dark:text-gray-400">{{ $estimators }}</p>
                </div>
            </div>
        </a>
        <a href="#"
            class="block max-w-sm p-6 bg-blue-100 border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <div class="flex">
                <div class="pt-5"><i class="fa-solid fa-cart-flatbed fa-2xl" style="color: #000000;"></i></div>
                <div class="pl-6">
                    <h5 class="mb-2 tracking-tight text-gray-500 dark:text-white">Jumlah Supplier</h5>
                    <p class="text-2xl font-bold text-gray-700 dark:text-gray-400">{{ $suppliers }}</p>
                </div>
            </div>
        </a>
    </div>
    {{-- Chart Untuk Kategori --}}
    <div class="grid mt-5 grid-cols-4 gap-2">
        <div class="bg-white rounded-lg border border-gray-200 shadow-xl">
            {!! $barangChart->container() !!}
        </div>
        <div class="bg-white rounded-lg border border-gray-200 shadow-xl">
            {!! $barangGudang1Chart->container() !!}
        </div>
        <div class="bg-white rounded-lg border border-gray-200 shadow-xl">
            {!! $barangGudang2Chart->container() !!}
        </div>
        <div class="bg-white rounded-lg border border-gray-200 shadow-xl">
            {!! $barangGudang3Chart->container() !!}
        </div>
    </div>
    <script src="{{ $barangChart->cdn() }}"></script>
    {{ $barangChart->script() }}

    <script src="{{ $barangGudang1Chart->cdn() }}"></script>
    {{ $barangGudang1Chart->script() }}

    <script src="{{ $barangGudang2Chart->cdn() }}"></script>
    {{ $barangGudang2Chart->script() }}

    <script src="{{ $barangGudang3Chart->cdn() }}"></script>
    {{ $barangGudang3Chart->script() }}

    
@endsection
