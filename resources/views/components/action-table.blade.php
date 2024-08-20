<div>
    <div class="flex space-x-1">
        @php
            $commonLinks = [
                'eye' => [
                    'class' => 'rounded-full w-8 h-8 bg-cyan-600 flex items-center justify-center',
                    'icon' => 'fas fa-lg fa-eye',
                ],
                'pdf' => [
                    'class' => 'rounded-full w-8 h-8 bg-red-600 flex items-center justify-center',
                    'icon' => 'fas fa-lg fa-file-pdf',
                ],
                'excel' => [
                    'class' => 'rounded-full w-8 h-8 bg-green-600 flex items-center justify-center',
                    'icon' => 'fas fa-lg fa-file-excel',
                ],
                'pencil' => [
                    'class' => 'rounded-full w-8 h-8 bg-teal-600 flex items-center justify-center',
                    'icon' => 'fas fa-lg fa-pencil',
                ],
                'moveTo' => [
                    'class' => 'rounded-full w-8 h-8 bg-orange-600 flex items-center justify-center',
                    'icon' => 'fas fa-duotone fa-arrow-right-arrow-left',
                ],
                'remove' => [
                    'class' => 'rounded-full w-8 h-8 bg-red-600 flex items-center justify-center',
                    'icon' => 'fas fa-lg fa-trash',
                ],
                'restore' => [
                    'class' => 'rounded-full w-8 h-8 bg-green-600 flex items-center justify-center',
                    'icon' => 'fas fa-lg fa-thumbs-up',
                ],
            ];
        @endphp

        @if ($data->imageables[1]->imageable_type === 'App\Models\Actor')
            @php
                $modelType = 'Actor';
                $info = $data;
                $permission = 'actors';
                $showRoute = route('actors.show', compact('data'));
                $editRoute = route('actors.edit', compact('data'));
                $pdfRoute = route('exports.pdf', compact('modelType', 'info'));
                $excelRoute = route('exports.excel', compact('modelType', 'info'));
                $moveToRoute = route('migrate.actorToExtra', $data->id);
                $removeRoute = route('actors.remove', compact('data'));
                $restoreRoute = route('actors.restore', compact('data'));
                // $destroyRoute = route('actors.destroy', compact('data'));
            @endphp
        @endif
        @if ($data->imageables[1]->imageable_type === 'App\Models\Xtra')
            @php
                $modelType = 'Xtra';
                $info = $data;
                $permission = 'extras';
                $showRoute = route('extras.show', compact('data'));
                $editRoute = route('extras.edit', compact('data'));
                $pdfRoute = route('exports.pdf', compact('modelType', 'info'));
                $excelRoute = route('exports.excel', compact('modelType', 'info'));
                $moveToRoute = route('migrate.extraToActor', $data->id);
                $removeRoute = route('extras.remove', compact('data'));
                $restoreRoute = route('extras.restore', compact('data'));
                // $destroyRoute = route('extras.destroy', compact('data'));
            @endphp
        @endif
        @if ($data->imageables[1]->imageable_type === 'App\Models\Coordinator')
            @php
                $modelType = 'Coordinator';
                $info = $data;
                $permission = 'coordinators';
                $showRoute = route('coordinators.show', compact('data'));
                $editRoute = route('coordinators.edit', compact('data'));
                $pdfRoute = route('exportsCoordinator.pdf', compact('modelType', 'info'));
                $excelRoute = route('exportsCoordinator.excel', compact('modelType', 'info'));
                $removeRoute = route('coordinators.remove', compact('data'));
                $restoreRoute = route('coordinators.restore', compact('data'));
                // $destroyRoute = route('extras.destroy', compact('data'));
            @endphp
        @endif

        @can('exports.pdf')
            <a href="{{ isset($pdfRoute) ? $pdfRoute : '#' }}" class="{{ $commonLinks['pdf']['class'] }}"
                @if (isset($pdfRoute)) @click="showModal = true" @endif>
                <i class="text-white {{ $commonLinks['pdf']['icon'] }}"></i>
            </a>
        @endcan
        @can('exports.excel')
            <a href="{{ isset($excelRoute) ? $excelRoute : '#' }}" class="{{ $commonLinks['excel']['class'] }}"
                @if (isset($excelRoute)) @click="showModal = true" @endif>
                <i class="text-white {{ $commonLinks['excel']['icon'] }}"></i>
            </a>
        @endcan
        @can($permission . '.show')
            <a href="{{ isset($showRoute) ? $showRoute : '#' }}" class="{{ $commonLinks['eye']['class'] }}"
                @click="showModal = true">
                <i class="text-white {{ $commonLinks['eye']['icon'] }}"></i>
            </a>
        @endcan
        @can($permission . '.edit')
            <a href="{{ isset($editRoute) ? $editRoute : '#' }}" class="{{ $commonLinks['pencil']['class'] }}"
                @click="showModal = true">
                <i class="text-white {{ $commonLinks['pencil']['icon'] }}"></i>
            </a>
        @endcan
        @if ($modelType != 'Coordinator')
            @canany(['migrate.actorToExtra', 'migrate.extraToActor'])
                <a href="{{ isset($moveToRoute) ? $moveToRoute : '#' }}" class="{{ $commonLinks['moveTo']['class'] }}"
                    @click="showModal = true">
                    <i class="text-white {{ $commonLinks['moveTo']['icon'] }}"></i>
                </a>
            @endcanany
        @endif

        @if ($data->removed == '0')
            @can($permission . '.remove')
                <form method="POST" action="{{ $removeRoute }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="{{ $commonLinks['remove']['class'] }}">
                        <i class="text-white {{ $commonLinks['remove']['icon'] }}"></i>
                    </button>
                </form>
            @endcan
        @else
            @can($permission . '.restore')
                <form method="POST" action="{{ $restoreRoute }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="{{ $commonLinks['restore']['class'] }}">
                        <i class="text-white {{ $commonLinks['restore']['icon'] }}"></i>
                    </button>
                </form>
            @endcan
        @endif
    </div>
</div>
