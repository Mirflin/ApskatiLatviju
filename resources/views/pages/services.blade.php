<x-layouts.public class="services-page header-margins min-h-screen flex flex-col">
    @include('components.services-filtration')
    <h2 class="text-3xl font-bold mb-6 text-center my-5">Pakalpojumi</h2>
    <div class="flex-grow mx-auto p-6 max-w-6xl">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            @forelse ($services as $service)
                <div class="border rounded-lg shadow-lg overflow-hidden bg-white p-4">
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
            @empty
                <p>Nav pieejamu pakalpojumu.</p>
            @endforelse
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
                <label for="surname" class="block font-semibold text-orange-800">
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
                <label for="telephone" class="block font-semibold text-orange-800">
                    Tālrunis
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
                <label for="service_id" class="block font-semibold text-orange-800">
                    Izvēlies pakalpojumu
                </label>
                <select
                    id="service_id"
                    name="service_id"
                    required
                    class="w-full border border-orange-300 rounded-md p-2"
                >
                    <option value="">-- Lūdzu, izvēlies --</option>
                    @foreach ($services as $serviceOption)
                        <option
                            value="{{ $serviceOption->id }}"
                            @if(isset($selectedService) && $selectedService->id == $serviceOption->id) selected @endif
                        >
                            {{ $serviceOption->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-2">
                <label for="comment" class="block font-semibold text-orange-800">
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