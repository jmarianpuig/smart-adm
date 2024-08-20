<div>
    @php
    $userEmail = $data['email'];
    @endphp
    <p class="text-black dark:text-white">
        <strong>{{ $data->formattedName }}</strong>
    </p>
    <div class="">
        <p class="text-xs text-cyan-800 dark:text-gray-400">
            <a target="_blank" href="mailto:{{ $userEmail }}" class="hover:text-blue-400">
                {{ $userEmail }}
            </a>

            <span> - </span>
            <a target="_blank" href="https://wa.me/34{{ $data->phone }}" class=" hover:text-blue-400">
                {{ $data->formattedPhone }}
            </a>
        </p>
    </div>
</div>
