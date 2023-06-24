@extends('estimator.layouts.main')

@section('content')
    <div class="text-3xl text-black font-semibold uppercase">
        dashboard
    </div>
    <div class="text-l text-black">
        Welcome Back, {{ Auth::user()->nama }}
    </div>
    <div class="grid mt-5 grid-cols-3 gap-2">
        <div class="bg-white rounded-lg border border-gray-200 shadow-xl">
            {!! $masukKeluarEstimatorChart->container() !!}
        </div>
    </div>

    <script src="{{ $masukKeluarEstimatorChart->cdn() }}"></script>
    {{ $masukKeluarEstimatorChart->script() }}


@endsection
