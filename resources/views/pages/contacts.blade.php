@section('title', 'Kontakti')

<x-layouts.public class="contacts-page bg-gray-100 min-h-screen">
    <!-- Hero Section -->
    <section class="py-16 px-6 bg-orange-700 text-white text-center">
        <div class="max-w-5xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-8">Kontakti</h1>
            <ul class="grid grid-cols-1 md:grid-cols-2 gap-6 contacts-list">
                <li
                    class="contact-item flex flex-col gap-3 bg-white text-gray-800 p-5 rounded-xl shadow-md hover:shadow-lg transition cursor-pointer relative"
                    tabindex="0"
                    data-contact-id="1"
                >
                    <div class="flex items-center gap-4">
                        <i class="fa-solid fa-user-tie text-orange-500 text-2xl"></i>
                        <div>
                            <p class="font-semibold text-lg">Aleksandrs Ostapjuks</p>
                            <p class="text-sm text-gray-500 w-fit">Administrators</p>
                        </div>
                    </div>
                    <div
                        class="absolute bottom-5 contact-extra-1 text-sm text-gray-600 pl-10 max-h-0 overflow-hidden transition-all duration-300 absolute bg-white z-10"
                    >
                        <p class="flex items-center gap-2 mt-2">
                            <i class="fa-solid fa-phone text-orange-400"></i>
                            +371 20000000
                        </p>
                        <p class="flex items-center gap-2 mt-1">
                            <i class="fa-solid fa-envelope text-orange-400"></i>
                            aleksandrs@apskatilatviju.lv
                        </p>
                    </div>
                </li>
                <li
                    class="contact-item flex flex-col gap-3 bg-white text-gray-800 p-5 rounded-xl shadow-md hover:shadow-lg transition cursor-pointer relative"
                    tabindex="0"
                    data-contact-id="2"
                >
                    <div class="flex items-center gap-4">
                        <i class="fa-solid fa-user-tie text-orange-500 text-2xl"></i>
                        <div>
                            <p class="font-semibold text-lg">Daniils Titovs</p>
                            <p class="text-sm text-gray-500 w-fit">Administrators</p>
                        </div>
                    </div>
                    <div
                        class="absolute bottom-5 contact-extra-2 text-sm text-gray-600 pl-10 max-h-0 overflow-hidden transition-all duration-300 absolute bg-white z-10"
                    >
                        <p class="flex items-center gap-2 mt-2">
                            <i class="fa-solid fa-phone text-orange-400"></i>
                            +371 21111111
                        </p>
                        <p class="flex items-center gap-2 mt-1">
                            <i class="fa-solid fa-envelope text-orange-400"></i>
                            daniils@apskatilatviju.lv
                        </p>
                    </div>
                </li>
            </ul>
        </div>
    </section>

    <!-- Quote Section -->
    <section class="py-12 px-6 bg-orange-600 text-white text-center">
        <div class="max-w-4xl mx-auto">
            <p class="text-2xl md:text-3xl font-semibold mb-4 italic">
                "The journey of a thousand miles begins with a single step."
            </p>
            <em class="text-lg md:text-xl">- Lao Tzu</em>
        </div>
    </section>

    <!-- Map and Info Section -->
    <section class="py-16 px-6 text-center">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Atradi mūs</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d416.87552555423207!2d21.030265330924312!3d56.531789608560686!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46faa632882520c9%3A0x992422259255007e!2sDarbn%C4%ABcu%20iela%208%2C%20Liep%C4%81ja%2C%20LV-3405!5e0!3m2!1sen!2slv!4v1750150580722!5m2!1sen!2slv"
                    width="100%"
                    height="450"
                    style="border: 0"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    class="rounded-xl shadow-md"
                ></iframe>
                <div class="text-left text-gray-800 space-y-4">
                    <h3 class="text-xl font-semibold">Mūsu adrese</h3>
                    <p class="flex items-center gap-2">
                        <i class="fa-solid fa-map-marker-alt text-orange-500"></i>
                        Darbnīcu iela 8, Liepāja, LV-3405, Latvija
                    </p>
                    <p class="flex items-center gap-2">
                        <i class="fa-solid fa-phone text-orange-500"></i>
                        +371 20000000
                    </p>
                    <p class="flex items-center gap-2">
                        <i class="fa-solid fa-envelope text-orange-500"></i>
                        info@apskatilatviju.lv
                    </p>
                    <h3 class="text-xl font-semibold mt-6">Darba laiks</h3>
                    <p>Pirmdiena–Piektdiena: 9:00–17:00</p>
                    <p>Sestdiena–Svētdiena: Slēgts</p>
                </div>
            </div>
        </div>
    </section>
</x-layouts.public>