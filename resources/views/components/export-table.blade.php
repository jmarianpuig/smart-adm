<div>
    <div class="flex space-x-1">
        @php
            $commonLinks = [
                'pdf' => [
                    'class' => 'rounded-full w-8 h-8 bg-red-600 flex items-center justify-center',
                    'icon' => 'fas fa-lg fa-file-pdf',
                ],
                'excel' => [
                    'class' => 'rounded-full w-8 h-8 bg-green-600 flex items-center justify-center',
                    'icon' => 'fas fa-lg fa-file-excel',
                ],
            ];
        @endphp

        @if ($data->imageables[1]->imageable_type === 'App\Models\Actor')
            @php
                $modelType = 'Actor';
                $info = $data;
                $pdfRoute = route('exports.pdf', compact('modelType', 'info'));
                $excelRoute = route('exports.excel', compact('modelType', 'info'));
            @endphp
        @endif
        @if ($data->imageables[1]->imageable_type === 'App\Models\Xtra')
            @php
                $modelType = 'Xtra';
                $info = $data;
                $pdfRoute = route('exports.pdf', compact('modelType', 'info'));
                $excelRoute = route('exports.excel', compact('modelType', 'info'));
            @endphp
        @endif


        <a href="{{ isset($pdfRoute) ? $pdfRoute : '#' }}" class="{{ $commonLinks['pdf']['class'] }}"
            @if (isset($pdfRoute)) @click="showModal = true" @endif>
            <i class="text-white {{ $commonLinks['pdf']['icon'] }}"></i>
        </a>
        <a href="{{ isset($excelRoute) ? $excelRoute : '#' }}" class="{{ $commonLinks['excel']['class'] }}"
            @if (isset($excelRoute)) @click="showModal = true" @endif>
            <i class="text-white {{ $commonLinks['excel']['icon'] }}"></i>
        </a>
    </div>
</div>
