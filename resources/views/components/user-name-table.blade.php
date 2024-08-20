<div>
    <p class="text-black dark:text-white">
        <strong>{{ $data->full_name }}</strong>
    </p>
    <div class="">
        <p class="text-xs text-cyan-800 dark:text-gray-400">
            <a target="_blank" href="mailto:{{ $data->email }}" class="hover:text-blue-400">
                {{ $data->email }}
            </a>

            <span> - </span>
            <a target="_blank" href="https://wa.me/+34{{ $data->phone }}" class=" hover:text-blue-400">
                {{ $data->formattedPhone }}
            </a>
        </p>
    </div>
</div>
