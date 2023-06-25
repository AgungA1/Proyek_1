@extends('staf.layouts.main')

@section('content')
    <div class="text-3xl text-black font-semibold uppercase">
        dashboard
    </div>
    <div class="text-l text-black">
        Welcome Back, {{ Auth::guard('staf_gudang')->user()->nama }}
    </div>
    <div class="grid mt-5 grid-cols-3 gap-2">
        <div class="bg-white rounded-lg border border-gray-200 shadow-xl">
            {!! $stafChart->container() !!}
        </div>
        <div class="bg-white rounded-lg border border-gray-200 shadow-xl">
            {!! $masukKeluarStafChart->container() !!}
        </div>
    </div>
   
    <script src="{{ $stafChart->cdn() }}"></script>
    {{ $stafChart->script() }}

    <script src="{{ $masukKeluarStafChart->cdn() }}"></script>
    {{ $masukKeluarStafChart->script() }}

    
@endsection
