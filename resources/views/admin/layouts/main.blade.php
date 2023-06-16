<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    @include('admin.layouts.navbar')
    @include('admin.layouts.sidebar')
    <!-- Wrapper -->
    <div class="p-4 sm:ml-64 bg-white min-h-screen h-max"> 
        <!-- Content Warapper -->
        <div class="p-4 mt-14">
            <!-- Content -->
            @yield('content')
            @yield('script')
        </div>
    </div>
</body>

</html>
