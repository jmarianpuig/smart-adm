<div>
    <div class="flex-1 bg-white dark:bg-gray-700 rounded-lg shadow-xl p-4">
        <h4 class="text-xl text-gray-900 dark:text-white font-bold border-b py-2 dark:border-gray-500">Imágen 1</h4>
        <p class="mt-2 text-gray-700">
            @php
                $imageUrl = getImagePath($url . $info->imageables[1]->url) ;
                $defaultImageUrl = getImagePath($url . 'noPhoto.jpg');

                $contents = @file_get_contents($imageUrl);
                if ($contents == false) {
                    $imageUrl = $defaultImageUrl;
                }
            @endphp
            <img class="w-full rounded-lg border border-gray-500 shadow-[0px_0px_10px_0px_#4A5568]" alt="..."
                src="{{ $imageUrl }}?{{ rand() }}" />
        </p>
    </div>
    @if ($info->imageables[1]->imageable_type !== 'App\Models\Coordinator')
        <div class="flex-1 bg-white dark:bg-gray-700 rounded-lg shadow-xl p-4 mt-4">
            <h4 class="text-xl text-gray-900 dark:text-white font-bold border-b py-2 dark:border-gray-500">Imágen 2</h4>
            <p class="mt-2 text-gray-700">
                @php
                    $imageUrl2 = getImagePath($url . $info->imageables[2]->url);
                    $defaultImageUrl = getImagePath($url . 'noPhoto.jpg');

                    $contents = @file_get_contents($imageUrl2);
                    if ($contents === false) {
                        $imageUrl2 = $defaultImageUrl;
                    }
                @endphp
                <img class="w-full rounded-lg border border-gray-500 shadow-[0px_0px_10px_0px_#4A5568]" alt="..."
                    src="{{ $imageUrl2 }}?{{ rand() }}" />
            </p>
        </div>
    @endif
</div>
