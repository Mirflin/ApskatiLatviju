@section('title', $travel->name)

@vite(['resources/js/modal.js'])

<x-layouts.public
    class="travel-details-page header-margins min-h-screen flex flex-col"
>
    <div class="max-w-6xl mx-auto p-6 flex-grow">
        @if (session('success'))
            <div
                class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6"
            >
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div
                class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6"
            >
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div
            class="bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col lg:flex-row"
        >
            <div class="p-8 flex flex-col justify-between lg:w-1/2">
                <div>
                    <h1 class="text-4xl font-bold mb-4 text-gray-800">
                        {{ $travel->name }}
                    </h1>
                    <h2 class="text-2xl font-bold mb-4 text-gray-300">
                        {{ $travel->road_marks }}
                    </h2>
                    <p class="text-gray-700 mb-6 text-lg leading-relaxed">
                        {{ $travel->description }}
                    </p>

                    <ul class="text-md text-gray-600 mb-6 space-y-2">
                        <li>
                            <strong>Pilsēta:</strong>
                            {{ $travel->city }}
                        </li>
                        <li>
                            <strong>Derīguma termiņš:</strong>
                            {{ $travel->formattedTimeTerm() }}
                        </li>
                        <li>
                            <strong>Brīvas vietas:</strong>
                            {{ $travel->spot_count }}
                        </li>
                        <li>
                            <strong>Cena:</strong>
                            €{{ number_format($travel->price, 2) }}
                        </li>
                    </ul>
                </div>

                <div class="flex flex-col gap-3 mt-6">
                    <button
                        onclick="openModal('travelRequest')"
                        class="bg-orange-500 text-white px-4 py-2 rounded"
                    >
                        Pieteikties ceļojumam
                    </button>

                    <a
                        href="{{ route('travels.index') }}"
                        class="text-orange-500 hover:underline text-center"
                    >
                        Atgriezties
                    </a>
                </div>
            </div>

            <div class="lg:w-1/2">
                <img
                    src="{{ $travel->image_url }}"
                    alt="{{ $travel->name }}"
                    class="w-full h-full object-cover"
                />
            </div>
        </div>
    </div>
    @include('layouts.review', ['travel' => $travel])
    <x-modal
        id="travelRequest"
        title="Pieteikuma forma"
        class="travel-request-page header-margins min-h-screen flex flex-col bg-white text-gray-800"
    >
        <form
            action="{{ route('travel.request.store') }}"
            method="POST"
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
                    value="{{ old('name') }}"
                    class="w-full border border-orange-300 rounded-md p-2"
                    required
                />
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
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
                    value="{{ old('surname') }}"
                    class="w-full border border-orange-300 rounded-md p-2"
                    required
                />
                @error('surname')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block font-semibold text-orange-800">
                    E-pasts
                </label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="w-full border border-orange-300 rounded-md p-2"
                    required
                />
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
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
                    maxlength="8"
                    minlength="8"
                    value="{{ old('telephone') }}"
                    class="w-full border border-orange-300 rounded-md p-2"
                    required
                />
                @error('telephone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label
                    for="people-count"
                    class="block font-semibold text-orange-800"
                >
                    Cilvēku skaits
                </label>
                <input
                    type="number"
                    id="people-count"
                    name="people-count"
                    value="{{ old('people-count', 1) }}"
                    class="w-full border border-orange-300 rounded-md p-2"
                    min="1"
                    max="50"
                    required
                />
                @error('people-count')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label
                    for="travel_id"
                    class="block font-semibold text-orange-800"
                >
                    Izvēlies ceļojumu
                </label>
                <select
                    name="travel_id"
                    id="travel_id"
                    class="w-full border border-orange-300 rounded-md p-2"
                    required
                >
                    <option value="">-- Lūdzu, izvēlies --</option>
                    @foreach ($allTravels as $option)
                        <option
                            value="{{ $option->id }}"
                            @if($travel && $travel->id === $option->id || old('travel_id') == $option->id) selected @endif
                        >
                            {{ $option->name }}
                            ({{ $option->city }})
                        </option>
                    @endforeach
                </select>
                @error('travel_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
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
                    cols="30"
                    rows="5"
                    class="w-full border border-orange-300 rounded-md p-2"
                >
{{ old('comment') }}</textarea
                >
                @error('comment')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2 flex justify-end">
                <button
                    type="submit"
                    class="text-white px-6 py-2 rounded bg-orange-500 hover:bg-orange-600 transition"
                >
                    Pieteikties
                </button>
            </div>
        </form>
    </x-modal>
</x-layouts.public>
