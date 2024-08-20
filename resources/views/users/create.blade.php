<x-app-layout>
@php
    // dd($user->name)
@endphp
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="xs:w-full xl:w-7/12 mx-auto py-4 px-4 sm:px-6 lg:px-4">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Crear Usuario
                </h2>
                <a href="{{ route('users.index') }}"
                class="bg-cyan-500 hover:bg-cyan-700 text-white font-bold py-2 px-3 rounded inline-block text-center" >Volver</a>
            </div>
        </div>
    </header>

    <div class="py-12">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="xs:w-full xl:w-7/12 mx-auto sm:px-6 lg:px-8 h-fit bg-white dark:bg-gray-800 dark:text-white rounded-lg shadow-xl p-4">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" id="createUser" action="{{ route('users.store') }}"  role="form" enctype="multipart/form-data">
                        @csrf

                        @include('users.form')
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
