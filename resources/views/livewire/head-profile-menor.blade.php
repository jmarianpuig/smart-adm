<div>
    <div class="w-full h-[250px]">
        <img src="{{ asset('images/profile-background.jpg') }}"
            class="w-full h-full rounded-tl-lg rounded-tr-lg">
    </div>
    @php
        $imageUrl = $url . $info->imageables[0]->url;
    @endphp
    <div class="flex flex-col items-center -mt-20">
        <img src="{{ $imageUrl }}"
            class="w-40 border-4 border-white rounded-full">
        <div class="flex items-center space-x-2 mt-2">
            <p class="text-2xl">
                {{ $info->full_name }}
            </p>
        </div>
        @php
            $type = $info->imageables[1]->imageable_type;
            $model = $type;
            ($model === 'App\Models\Actor' && $info->gender === 'Hombre') ? $type = 'Actor Menor' : $type = 'Actríz Menor';
            ($model === 'App\Models\Xtra') ? $type = 'Figurante Menor' : $type;

        @endphp
        <p class="text-gray-700 dark:text-gray-200">{{ $type }}</p>
        <p class="text-sm text-gray-500 dark:text-white mt-2">{{ $info->municipio->municipio }},
            {{ $info->municipio->provincia->provincia }}</p>
    </div>
</div>
