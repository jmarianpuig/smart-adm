<div>
    <div class="flex space-x-1">
        @php
            $commonLinks = [
                'edit' => [
                    'class' => 'rounded-full w-8 h-8 bg-green-600 flex items-center justify-center',
                    'icon' => 'fas fa-lg fa-pencil',
                ],
                'eye' => [
                    'class' => 'rounded-full w-8 h-8 bg-cyan-600 flex items-center justify-center',
                    'icon' => 'fas fa-lg fa-eye',
                ],
                'remove' => [
                    'class' => 'rounded-full w-8 h-8 bg-red-600 flex items-center justify-center',
                    'icon' => 'fas fa-lg fa-trash',
                ],
                'restore' => [
                    'class' => 'rounded-full w-8 h-8 bg-green-600 flex items-center justify-center',
                    'icon' => 'fas fa-lg fa-thumbs-up',
                ],
                // 'delete' => [
                //     'class' => 'rounded-full w-8 h-8 bg-red-600 flex items-center justify-center',
                //     'icon' => 'fas fa-lg fa-trash-alt',
                // ],
            ];

            $editRoute = route('events.edit', compact('data'));
            $showRoute = route('events.show', compact('data'));
            $removeRoute = route('events.remove', compact('data'));
            $restoreRoute = route('events.restore', compact('data'));
            $trashRoute = route('events.destroy', compact('data'));

        @endphp
        @can('events.edit')
            <a href="{{ isset($editRoute) ? $editRoute : '#' }}" class="{{ $commonLinks['edit']['class'] }}">
                <i class="text-white {{ $commonLinks['edit']['icon'] }}"></i>
            </a>
        @endcan
        @can('events.show')
            <a href="{{ isset($showRoute) ? $showRoute : '#' }}" class="{{ $commonLinks['eye']['class'] }}">
                <i class="text-white {{ $commonLinks['eye']['icon'] }}"></i>
            </a>
        @endcan
        @can('events.destroy')
            @if ($data->removed == 0)
                <form method="POST" action="{{ $removeRoute }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="{{ $commonLinks['remove']['class'] }}">
                        <i class="text-white {{ $commonLinks['remove']['icon'] }}"></i>
                    </button>
                </form>
            @else
                <form method="POST" action="{{ $restoreRoute }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="{{ $commonLinks['restore']['class'] }}">
                        <i class="text-white {{ $commonLinks['restore']['icon'] }}"></i>
                    </button>
                </form>
            @endif
        @endcan
        {{-- @can('events.destroy')
            <form action="{{ isset($trashRoute) ? $trashRoute : '#' }}" method="post">
                @csrf
                @method('delete')
                <button class="{{ $commonLinks['delete']['class'] }}">
                    <i class="text-white {{ $commonLinks['delete']['icon'] }}"></i>
                </button>
            </form>
        @endcan --}}
    </div>
</div>
