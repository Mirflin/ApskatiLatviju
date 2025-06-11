<footer
    id="footer-content"
    class="flex flex-col sm:flex-row justify-between items-center p-4 bg-[var(--main-black)] text-[var(--main-white)] gap-4 sm:gap-0"
>
    <p class="w-full sm:w-auto text-center sm:text-left">
        <a
            href="{{ $footer->url }}"
            target="_blank"
            class="underline text-orange-300 hover:text-orange-500"
        >
            <i class="fa-solid fa-link"></i>
            {{ $footer->url_name }}
        </a>
    </p>
    <p class="w-full sm:w-auto text-center">{{ $footer->center_text }}</p>
    <div
        class="flex flex-wrap sm:flex-nowrap gap-2 justify-center sm:justify-start"
    >
        <a
            href="/support"
            class="flex items-center gap-2 px-4 py-2 bg-orange-500 hover:bg-orange-700 text-white rounded-full shadow-md transition"
        >
            <i class="fa-solid fa-headset"></i>
            Palīdzība
        </a>
        <button
            id="openModal"
            class="flex items-center gap-2 px-4 py-2 bg-orange-500 hover:bg-orange-700 text-white rounded-full shadow-md transition"
        >
            <i class="fa-solid fa-circle-info"></i>
            <span class="inline-block max-w-[10ch] truncate">
                {{ $footer->button_name }}
            </span>
        </button>
    </div>
</footer>

<!-- Modal window -->
<div
    id="infoModal"
    class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex justify-center items-center z-50 opacity-0 pointer-events-none transition-opacity duration-300"
>
    <div
        class="modal-window bg-[var(--main-white)] text-[var(--main-black)] rounded-2xl p-8 max-w-md w-full shadow-xl relative animate-fade-in-up m-5"
    >
        <button
            id="closeModal"
            class="absolute top-4 right-4 text-[var(--main-black)] hover:text-[var(--orange-red)] text-xl"
        >
            &times;
        </button>
        <h2 class="text-2xl font-bold mb-4 font-oswald">
            {{ $footer->modal_title }}
        </h2>

        <div
            class="modal-window-text space-y-4 text-gray-800 text-lg leading-relaxed"
        >
            {!! $footer->modal_text !!}
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('infoModal');
        const openBtn = document.getElementById('openModal');
        const closeBtn = document.getElementById('closeModal');

        openBtn.addEventListener('click', () => {
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100');
        });

        closeBtn.addEventListener('click', () => {
            modal.classList.add('opacity-0', 'pointer-events-none');
            modal.classList.remove('opacity-100');
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('opacity-0', 'pointer-events-none');
                modal.classList.remove('opacity-100');
            }
        });
    });
</script>


