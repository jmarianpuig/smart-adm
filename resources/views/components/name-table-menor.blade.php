<div>
    @php
        $email = '';
        $phone = '';

        if (isset($data['user.parents.email']) && isset($data['user.parents.phone'])) {
            $email = $data['user.parents.email'];
            $phone = $data['user.parents.phone'];
        } else {
            $email = $data['user.email'] ?? '';
            $phone = $data['phone'] ?? '';
        }

        $formattedPhone = substr($phone, 0, 3) . ' ' . substr($phone, 3, 3) . ' ' . substr($phone, 6, 3);
    @endphp
    <p class="text-black dark:text-white">
        <strong>{{ $data->full_name }}</strong>
    </p>
    <div class="">
        <p class="text-xs text-cyan-800 dark:text-gray-400">
            <a target="_blank" href="mailto:{{ $email }}" class="hover:text-blue-400">
                {{ $email }}
            </a>

            <span> - </span>
            <a target="_blank" href="https://wa.me/+34{{ $phone }}" class=" hover:text-blue-400">
                {{ $formattedPhone }}
            </a>
        </p>
    </div>
</div>
