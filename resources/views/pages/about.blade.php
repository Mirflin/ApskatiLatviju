<x-layouts.public class="about-page">
    <section class="about-hero py-16 px-6 text-white text-center bg-orange-500">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Par mums</h1>
            <p class="text-lg md:text-xl">
                Mēs ticam, ka ceļošana pa Latviju var būt gan aizraujoša, gan
                ērta. Mūsu mērķis ir palīdzēt tev atklāt šīs zemes skaistumu!
            </p>
        </div>
    </section>

    <section class="about-values py-16 px-6 bg-orange-100 text-gray-800">
        <div class="max-w-5xl mx-auto grid md:grid-cols-3 gap-8 text-center">
            <div>
                <i
                    class="fa-solid fa-map-location-dot text-4xl text-orange-600 mb-4"
                ></i>
                <h3 class="text-xl font-bold mb-2">Latvijas iepazīšana</h3>
                <p>
                    Sniedzam iespēju iepazīt apslēptos dārgumus un populārākās
                    vietas visā Latvijā.
                </p>
            </div>
            <div>
                <i
                    class="fa-solid fa-people-group text-4xl text-orange-600 mb-4"
                ></i>
                <h3 class="text-xl font-bold mb-2">Draudzīga kopiena</h3>
                <p>
                    Mēs veidojam platformu, kurā ceļotāji var dalīties pieredzē
                    un ieteikumos.
                </p>
            </div>
            <div>
                <i class="fa-solid fa-globe text-4xl text-orange-600 mb-4"></i>
                <h3 class="text-xl font-bold mb-2">Digitāla ērtība</h3>
                <p>
                    Viegla ceļojumu pārvaldība tiešsaistē – pieteikumi,
                    informācija un atbalsts.
                </p>
            </div>
        </div>
    </section>

    <section
        class="about-contact py-16 px-6 bg-orange-600 text-white text-center"
    >
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold mb-6">Sazinies ar mums</h2>
            <p class="mb-4">
                Ja tev ir jautājumi, idejas vai vēlies sadarboties – raksti
                mums!
            </p>
            <div class="text-lg">
                <a
                    href="{{route('support')}}"
                    class="m-4 px-4 py-2.5 bg-orange-500 hover:bg-orange-700 text-white rounded-full shadow-md transition"
                >
                    Man ir jautājumi / idejas
                </a>
                <button
                    onclick="openModal('infoModal')"
                    class="m-4 px-4 py-2 bg-orange-500 hover:bg-orange-700 text-white rounded-full shadow-md transition"
                >
                    Gribu sazināties
                </button>
            </div>
        </div>
    </section>
</x-layouts.public>
