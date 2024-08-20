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
                'delete' => [
                    'class' => 'rounded-full w-8 h-8 bg-red-600 flex items-center justify-center',
                    'icon' => 'fas fa-lg fa-trash-alt',
                ],
            ];

            $editRoute = route('roles.edit', compact('role'));
            $showRoute = route('roles.show', compact('role'));
            $trashRoute = route('roles.destroy', compact('role'));
        @endphp

        <a href="{{ isset($editRoute) ? $editRoute : '#' }}" class="{{ $commonLinks['edit']['class'] }}">
            <i class="text-white {{ $commonLinks['edit']['icon'] }}"></i>
        </a>
        <a href="{{ isset($showRoute) ? $showRoute : '#' }}" class="{{ $commonLinks['eye']['class'] }}">
            <i class="text-white {{ $commonLinks['eye']['icon'] }}"></i>
        </a>
        @if ($role->id >= 6)
            <form action="{{ isset($trashRoute) ? $trashRoute : '#' }}" method="post">
                @csrf
                @method('delete')
                <button class="{{ $commonLinks['delete']['class'] }}">
                    <i class="text-white {{ $commonLinks['delete']['icon'] }}"></i>
                </button>
            </form>
        @endif
    </div>
</div>
