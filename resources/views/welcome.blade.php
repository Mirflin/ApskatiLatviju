@section('title', 'Sākums')

<x-layouts.public>
    <div class="start-section radial-gradient-circle">
<div class="l-content roadmap lg:mx-20">
            <section
                class="py-16 text-white"
            >
                <div
                    class="max-w-5xl mx-auto grid md:grid-cols-3 gap-8 text-center"
                >
                    <div class="growing-underline">
                        <i
                            class="fa-solid fa-map-location-dot text-4xl text-gray-150 mb-4"
                        ></i>
                        <h3 class="text-xl font-bold mb-2">
                            Latvijas iepazīšana
                        </h3>
                        <p>
                            Sniedzam iespēju iepazīt apslēptos dārgumus un
                            populārākās vietas visā Latvijā.
                        </p>
                    </div>
                    <div class="growing-underline">
                        <i
                            class="fa-solid fa-people-group text-4xl text-gray-150 mb-4"
                        ></i>
                        <h3 class="text-xl font-bold mb-2">
                            Draudzīga kopiena
                        </h3>
                        <p>
                            Mēs veidojam platformu, kurā ceļotāji var dalīties
                            pieredzē un ieteikumos.
                        </p>
                    </div>
                    <div class="growing-underline">
                        <i
                            class="fa-solid fa-globe text-4xl text-gray-150 mb-4"
                        ></i>
                        <h3 class="text-xl font-bold mb-2">Digitāla ērtība</h3>
                        <p>
                            Viegla ceļojumu pārvaldība tiešsaistē – pieteikumi,
                            informācija un atbalsts.
                        </p>
                    </div>
                </div>
            </section>
        </div>

        <div class="r-content">
            <h1>Apskati skaistāko Latvijā</h1>
            <p>
                Ceļojumu piedāvājumu pārvaldības sistēma “Apskati Latviju” ir
                paredzēta, lai atvieglotu ceļojumu organizatora pakalpojumu
                sniegšanu un popularizēšanu Latvijā.
            </p>
            <a
                href="{{ route('travels.index') }}"
                class="btn-big box-shadow-item"
            >
                Sākt
            </a>
        </div>
    </div>
</x-layouts.public>
