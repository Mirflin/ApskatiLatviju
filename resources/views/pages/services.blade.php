@section('title', 'Pakalpojumi')

<x-layouts.public
    class="services-page header-margins min-h-screen flex flex-col"
>
    @include('components.services-filtration')
    <h2 class="text-3xl font-bold mb-6 text-center my-5">Pakalpojumi</h2>
    <div class="flex-grow mx-auto p-6 max-w-6xl">
        <div
            id="services-container"
            class="grid grid-cols-1 lg:grid-cols-3 gap-6"
        >
            @forelse ($services as $service)
                <div
                    class="services-item border rounded-lg shadow-lg overflow-hidden bg-white p-4"
                >
                    <h3 class="text-xl font-semibold mb-2">
                        {{ $service->name }}
                    </h3>
                    <p class="text-gray-700 mb-2">
                        {{ $service->description }}
                    </p>
                    <p class="text-orange-600 font-bold">
                        €{{ number_format($service->price, 2, '.', ',') }}
                    </p>
                    <button
                        onclick="openModal('servicesRequest')"
                        class="inline-block mt-3 text-orange-500 hover:underline"
                    >
                        Pieteikties
                    </button>
                </div>
            @endforeach
            @if(count($services) === 0)
                <p>Nav pieejamu pakalpojumu.</p>
            @endif
        </div>

        <div
            id="js-pagination"
            class="flex items-center justify-center mt-6"
            @if(count($services) <= 3) style="display: none;" @endif
        >
            <nav
                class="inline-flex rounded-md shadow-sm"
                role="navigation"
                aria-label="Lapas navigācija"
            >
                <button
                    id="prev-page"
                    class="px-4 py-2 border border-orange-500 bg-white text-orange-600 hover:bg-orange-50 rounded-l-md"
                >
                    Atpakaļ
                </button>

                <span
                    class="px-4 py-2 border-t border-b border-orange-400 bg-white text-orange-600"
                    id="current-page"
                >
                    1
                </span>

                <button
                    id="next-page"
                    class="px-4 py-2 border border-orange-500 bg-white text-orange-600 hover:bg-orange-50 rounded-r-md"
                >
                    Nākamā
                </button>
            </nav>
        </div>
    </div>
    <x-modal
        id="servicesRequest"
        title="Pieteikuma forma"
        class="travel-request-page bg-white text-gray-800"
    >
        <form
            method="POST"
            action="{{ route('service.request') }}"
            class="grid grid-cols-1 md:grid-cols-2 gap-4"
        >
            @csrf

            <div>
                <label for="name" class="block font-semibold text-orange-800">
                    Vārds
                </label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    required
                    class="w-full border border-orange-300 rounded-md p-2"
                />
            </div>

            <div>
                <label
                    for="surname"
                    class="block font-semibold text-orange-800"
                >
                    Uzvārds
                </label>
                <input
                    type="text"
                    id="surname"
                    name="surname"
                    required
                    class="w-full border border-orange-300 rounded-md p-2"
                />
            </div>

            <div>
                <label for="email" class="block font-semibold text-orange-800">
                    E-pasts
                </label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    class="w-full border border-orange-300 rounded-md p-2"
                />
            </div>

            <div>
                <label
                    for="telephone"
                    class="block font-semibold text-orange-800"
                >
                    Tālruņa numurs (+371)
                </label>
                <input
                    type="tel"
                    id="telephone"
                    name="telephone"
                    required
                    class="w-full border border-orange-300 rounded-md p-2"
                />
            </div>

            <div>
                <label
                    for="service_id"
                    class="block font-semibold text-orange-800"
                >
                    Izvēlies pakalpojumu
                </label>
            <select
                name="service_id"
                id="service_id"
                class="w-full border border-orange-300 rounded-md p-2"
                required
            >
                <option value="">-- Lūdzu, izvēlieties --</option>
                @foreach ($allServices as $option)
                    <option
                        value="{{ $option->id }}"
                        @if(old('service_id') == $option->id || (isset($service) && $service->id == $option->id)) selected @endif
                    >
                        {{ $option->name }} ({{ $option->price }} €)
                    </option>
                @endforeach
            </select>
            </div>

            <div class="md:col-span-2">
                <label
                    for="comment"
                    class="block font-semibold text-orange-800"
                >
                    Komentārs
                </label>
                <textarea
                    name="comment"
                    id="comment"
                    rows="4"
                    class="w-full border border-orange-300 rounded-md p-2"
                ></textarea>
            </div>

            <div class="md:col-span-2 text-right">
                <button
                    type="submit"
                    class="bg-orange-500 text-white px-6 py-2 rounded hover:bg-orange-600"
                >
                    Pieteikties
                </button>
            </div>
        </form>
    </x-modal>
</x-layouts.public>
