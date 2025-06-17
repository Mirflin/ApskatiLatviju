<div
    id="{{ $id }}"
    class="modal fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex justify-center items-center z-50 opacity-0 pointer-events-none transition-opacity duration-300"
>
    <div
        class="modal-window bg-white text-black rounded-2xl p-8 max-w-2xl w-full shadow-xl relative m-4"
        style="max-height: 80vh; overflow-y: auto;"
        onclick="event.stopPropagation()"
    >
        <button
            class="absolute top-4 right-4 text-black hover:text-red-500 text-2xl font-bold"
            onclick="closeModal('{{ $id }}')"
        >
            ×
        </button>

        @if ($title)
            <h2 class="text-2xl font-bold mb-4">{{ $title }}</h2>
        @endif

        <div class="px-6">
            {{ $slot }}
        </div>
    </div>
</div>