<footer
    id="footer-content"
    class="flex flex-col sm:flex-row justify-between items-center p-4 bg-[var(--main-black)] text-[var(--main-white)] gap-4 sm:gap-0"
>
    <p class="w-full sm:w-auto text-center sm:text-left">
        repo:
        <a
            href="https://github.com/Mirflin/ApskatiLatviju"
            target="_blank"
            class="underline text-orange-300 hover:text-orange-500"
        >
            <i class="fa-brands fa-github"></i>
            Mirflin/ApskatiLatviju
        </a>
    </p>
    <p class="w-full sm:w-auto text-center">Ostapjuks & Titovs</p>
    <div class="w-full sm:w-auto flex justify-center sm:justify-start">
        <button
            id="openModal"
            class="flex items-center gap-2 px-4 py-2 bg-orange-500 hover:bg-orange-700 text-white rounded-full shadow-md transition mx-auto sm:mx-0"
        >
            <i class="fa-solid fa-circle-info"></i>
            PROJEKTS
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
        <h2 class="text-2xl font-bold mb-4 font-oswald">Par projektu</h2>

        <div
            class="modal-window-text space-y-4 text-gray-800 text-lg leading-relaxed"
        >
            <p>
                <strong>Šo projektu izstrādājuši</strong>
                Latvijas Valsts tehnikuma studenti
                <span class="text-black font-semibold">
                    Aleksandrs Ostapjuks
                </span>
                un
                <span class="text-black font-semibold">Daniils Titovs</span>
                .
            </p>
            <p>
                Projekta mērķis ir demonstrēt prasmes tīmekļa izstrādē,
                izmantojot mūsdienīgas tehnoloģijas.
            </p>
            <p>
                Tas izstrādāts ar
                <span class="font-semibold text-black">Laravel</span>
                ietvarstruktūru, kā arī integrējot vairākus ārējos rīkus un
                bibliotēkas.
            </p>
            <p>
                Detalizētāku tehnisko informāciju var atrast projekta
                repozitorijā vietnē
                <a
                    href="https://github.com/Mirflin/ApskatiLatviju"
                    target="_blank"
                    class="text-blue-600 hover:underline inline-flex items-center gap-1"
                >
                    GitHub
                    <i class="fa-brands fa-github text-xl"></i>
                </a>
                .
            </p>
        </div>

        <style>
            @keyframes fade-in-up {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-fade-in-up {
                animation: fade-in-up 0.3s ease-out;
            }

            footer {
            }

            /* modal */
            #infoModal {
                z-index: 9999 !important;
            }

            .modal-window {
                max-height: 50vh;
                display: flex;
                flex-direction: column;
            }

            .modal-window-text {
                overflow-y: auto;
                flex-grow: 1;
            }
            /* --- */
        </style>

        <script>
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
        </script>
    </div>
</div>
