<div>
    <div class="flex space-x-1">
        @php

            $eventId = $data->pivot->event_id;
            $viewerId = $data->pivot->viewer_id;

            if ($data->pivot->is_selected == '0') {
                $commonLinks = [
                    'update' => [
                        'class' => 'rounded-full w-8 h-8 bg-red-600 flex items-center justify-center',
                        'icon' => 'fas fa-lg fa-plus',
                    ],
                ];
            } else {
                $commonLinks = [
                    'update' => [
                        'class' => 'rounded-full w-8 h-8 bg-green-600 flex items-center justify-center',
                        'icon' => 'fas fa-lg fa-minus',
                    ],
                ];
            }
            $updateRoute = route('viewers.update');
        @endphp
        <form action="{{ isset($updateRoute) ? $updateRoute : '#' }}" method="post">
            @csrf
            @method('patch')

            <input type="hidden" name="event_id" value="{{ $eventId }}">
            <input type="hidden" name="viewer_id" value="{{ $viewerId }}">
            <button class="{{ $commonLinks['update']['class'] }}">
                <i class="text-white {{ $commonLinks['update']['icon'] }}"></i>
            </button>
        </form>
    </div>
</div>
