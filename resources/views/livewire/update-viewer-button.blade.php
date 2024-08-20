<div>
    <div class="flex space-x-1">
        <button wire:click="update" class="rounded-full w-8 h-8 flex items-center justify-center {{ $isSelected ? 'bg-green-600' : 'bg-red-600' }}">
            <i class="text-white {{ $isSelected ? 'fas fa-lg fa-minus' : 'fas fa-lg fa-plus' }}"></i>
        </button>
    </div>
</div>
