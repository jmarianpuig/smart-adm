<div>
    @php
        $colors = [
            'super-admin' => 'bg-slate-500',
            'Administrador' => 'bg-blue-500',
            'Supervisor' => 'bg-teal-500',
            'Coordinador' => 'bg-orange-500',
            'Invitado' => 'bg-cyan-500',
            'Sin Rol' => 'bg-red-500',
            // Agregar más roles y colores
        ];
        $colorClass = $colors[$role] ?? 'bg-red-500';
    @endphp
    <span class="inline-block rounded-full px-3 py-1 text-xs font-semibold text-white {{ $colorClass }}">
        {{ !($role) ? 'Sin Rol' : $role }}
    </span>
</div>
