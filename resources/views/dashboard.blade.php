<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="container items-center px-4 py-8 m-auto mt-5">
                <div class="flex flex-wrap pb-3 mx-4 md:mx-24 lg:mx-0">
                    <div class="w-full p-2 lg:w-1/3 md:w-1/2">
                        <livewire:charts.updates-chart :model="$extras" type="Figurantes" />
                    </div>
                    <div class="w-full p-2 lg:w-1/3 md:w-1/2">
                        <livewire:charts.updates-chart :model="$actors" type="Actores" />
                    </div>
                    <div class="w-full p-2 lg:w-1/3 md:w-1/2">
                        <livewire:charts.underage-users />
                    </div>
                </div>
                <div class="flex flex-wrap pb-3 mx-4 md:mx-24 lg:mx-0">
                    <div class="w-full p-2 lg:w-1/2 md:full-w">
                        <livewire:charts.users-by-age />
                    </div>
                    <div class="w-full p-2 lg:w-1/2 md:full-w">
                        <livewire:charts.montly-users />
                    </div>
                </div>
                <div class="flex flex-wrap pb-3 mx-4 md:mx-24 lg:mx-0">
                    <div class="w-full p-2 lg:w-1/2 md:full-w">
                        <livewire:charts.users-gender />
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</x-app-layout>
