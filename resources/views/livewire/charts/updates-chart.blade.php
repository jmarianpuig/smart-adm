<div>
    <div
        class="flex flex-col px-6 py-10 overflow-hidden bg-white hover:bg-gradient-to-br hover:from-purple-400 hover:via-blue-400 hover:to-blue-500 rounded-xl shadow-lg duration-300 hover:shadow-2xl group">
        <div class="flex flex-row justify-between items-center">
            <div class="px-4 py-4 bg-gray-300  rounded-xl bg-opacity-30 mr-2">
                <i class="fa-solid fa-xl fa-masks-theater  w-6 group-hover:text-gray-50"></i>
            </div>
            <div class="inline-flex text-sm text-gray-600 group-hover:text-gray-200 sm:text-base">
                <p class="mr-2  group-hover:text-gray-200" style="font-size: 12px;">Última semana</p>
                <i class="fa-solid fa-circle-plus h-6 w-6 sm:text-base text-green-500 group-hover:text-gray-200"></i>
                <p class="sm:text-base text-green-500 font-bold group-hover:text-gray-200">{{ $countLastSevenDays }}</p>
            </div>
        </div>
        <h1 class="text-3xl sm:text-4xl xl:text-5xl font-bold text-gray-700 mt-12 group-hover:text-gray-50">
            {{ $model->count() }}</h1>
        <div class="flex flex-row justify-between group-hover:text-gray-200">
            <p>{{ $type }}</p>
        </div>
    </div>
</div>
