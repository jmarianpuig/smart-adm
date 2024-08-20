<div>
    <div>
        <div class="flex space-x-1">
            @php
                $commonLinks = [
                    'file' => [
                        'class' => 'rounded-full w-8 h-8 bg-cyan-600 flex items-center justify-center',
                        'icon' => 'fas fa-lg fa-file',
                    ],
                ];
            @endphp
            @if ($data->fileable_type === 'App\Models\Coordinator')
                @php
                    $modelType = 'Coordinator';
                    $urls = $data->url;
                    $fileRoute = getFilePath() . '/coordinators/';
                    // $urls = 'https://smartfiguracion.es/public/files/coordinators/';
                @endphp
            @else
                {{-- si hay ms modelos con archivos, mientras devuelvo a dashboard --}}
                @php
                    return redirect()->route('dashboard');
                @endphp
            @endif
            {{-- @dd($fileRoute . $urls) --}}
            <a href="{{ isset($fileRoute) ? $fileRoute . $urls : '#' }}" class="{{ $commonLinks['file']['class'] }}"
                target="_blank" @if (isset($fileRoute)) @click="showModal = true" @endif>
                <i class="text-white {{ $commonLinks['file']['icon'] }}"></i>
            </a>
        </div>
    </div>

</div>
