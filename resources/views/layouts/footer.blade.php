<footer
    id="footer-content"
    class="flex flex-col sm:flex-row justify-between items-center p-4 bg-[var(--main-black)] text-[var(--main-white)] gap-4 sm:gap-0"
>
    <p class="w-full sm:w-auto text-center sm:text-left">
        <a
            href="https://github.com/Mirflin/ApskatiLatviju"
            target="_blank"
            class="underline text-orange-300 hover:text-orange-500"
        >
            <i class="fa-solid fa-link"></i>
            Mirflin/ApskatiLatviju
        </a>
    </p>
    <div
        class="flex flex-wrap sm:flex-nowrap gap-2 justify-center sm:justify-start"
    >
        <a
            href="{{route('support')}}"
            class="flex items-center gap-2 px-4 py-2 bg-orange-500 hover:bg-orange-700 text-white rounded-full shadow-md transition"
        >
            <i class="fa-solid fa-headset"></i>
            Palīdzība
        </a>
        <button
            onclick="openModal('infoModal')"
            class="flex items-center gap-2 px-4 py-2 bg-orange-500 hover:bg-orange-700 text-white rounded-full shadow-md transition"
        >
            <i class="fa-solid fa-circle-info"></i>
            <span class="inline-block max-w-[10ch] truncate">
                Kontakti
            </span>
        </button>
    </div>
</footer>

<x-modal
    id="infoModal"
    title="Kontakti"
    class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex justify-center items-center z-50 opacity-0 pointer-events-none transition-opacity duration-300"
>
    <ul class="space-y-4 contacts-list">
        <li
            class="contact-item flex flex-col gap-3 border p-3 rounded-md shadow-sm hover:shadow-md transition cursor-pointer"
            tabindex="0"
        >
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-user-tie text-orange-500 text-xl"></i>
                <div>
                    <p class="font-semibold">Aleksandrs Ostapjuks</p>
                    <p class="text-sm text-gray-500">Administrators</p>
                </div>
            </div>
            <div
                class="contact-extra text-sm text-gray-700 pl-[38px] max-h-0 overflow-hidden transition-all duration-300"
            >
                <p><i class="fa-solid fa-phone text-orange-400 mr-2"></i>+371 20000000</p>
                <p><i class="fa-solid fa-envelope text-orange-400 mr-2"></i>aleksandrs@apskatilatviju.lv</p>
            </div>
        </li>
        <li
            class="contact-item flex flex-col gap-3 border p-3 rounded-md shadow-sm hover:shadow-md transition cursor-pointer"
            tabindex="0"
        >
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-user-tie text-orange-500 text-xl"></i>
                <div>
                    <p class="font-semibold">Daniils Titovs</p>
                    <p class="text-sm text-gray-500">Administrators</p>
                </div>
            </div>
            <div
                class="contact-extra text-sm text-gray-700 pl-[38px] max-h-0 overflow-hidden transition-all duration-300"
            >
                <p><i class="fa-solid fa-phone text-orange-400 mr-2"></i>+371 21111111</p>
                <p><i class="fa-solid fa-envelope text-orange-400 mr-2"></i>daniils@apskatilatviju.lv</p>
            </div>
        </li>
    </ul>
</x-modal>


