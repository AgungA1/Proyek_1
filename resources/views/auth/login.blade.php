<x-guest-layout>
    <h1 class="mt-8 text-5xl font-extrabold leading-none tracking-tight text-gray-900 md:text-6xl lg:text-7xl dark:text-white flex">W<span class=" text-4xl md:text-5xl lg:text-6xl underline underline-offset-3 decoration-8 decoration-green-400 dark:decoration-green-600">elcome,</span></h1>
    <h2 class="mb-6 text-3xl font-bold dark:text-white">Omega Art`s Inventory System</h2>
    <hr class="w-48 h-1 mx-auto my-4 bg-gray-100 border-0 rounded md:my-10 dark:bg-gray-700">
    <div class="mb-4 flex flex-col justify-center items-center">
        <p class="mb-3 text-center text-gray-900 dark:text-white">Continue to the website as :</p>
        <div class="flex flex-row py-4">
            <a href="{{route('admin.login')}}">
                <button type="button" class="text-gray-900 hover:text-white border border-grey-400 hover:bg-green-400 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-green-400 dark:focus:ring-yellow-900">Admin</button>
            </a>
            <a href="{{route('staf.login')}}">
                <button type="button" class="text-gray-900 hover:text-white border border-grey-400 hover:bg-green-400 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-green-400 dark:focus:ring-yellow-900">Staff Gudang</button>
            </a>
            <a href="{{route('estimator.login')}}">
                <button type="button" class="text-gray-900 hover:text-white border border-grey-400 hover:bg-green-400 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-green-400 dark:focus:ring-yellow-900">Estimator</button>
            </a>
        </div>
    </div>
</x-guest-layout>
