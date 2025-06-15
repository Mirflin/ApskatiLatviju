<x-layouts.public class="travels-page">
    @include('components.travels-filtration')

    <h2 class="text-3xl font-bold mb-6 text-center my-5">Ceļojumi</h2>
    <div class="flex-grow mx-auto p-6 max-w-6xl">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            @forelse ($travels as $travel)
                <div class="border rounded-lg shadow-lg overflow-hidden bg-white">
                    <img
                        src="{{ $travel->image_url }}"
                        alt="{{ $travel->name }}"
                        class="w-full h-78 object-cover"
                    />
                    <div class="p-4">
                        <h3 class="text-xl font-semibold mb-2">
                            {{ $travel->name }} - {{ $travel->city }}
                        </h3>
                        <ul class="text-sm text-gray-600 mb-2">
                            <li>
                                <strong>Derīguma termiņš:</strong>
                                {{ $travel->formattedTimeTerm() }}
                            </li>
                            <li>
                                <strong>Brīvas vietas:</strong>
                                {{ $travel->spot_count }}
                            </li>
                        </ul>
                        <a
                            href="{{ route('travel.details', $travel->id) }}"
                            class="inline-block mt-3 text-orange-500 hover:underline"
                        >
                            Lasīt vairāk
                        </a>
                    </div>
                </div>
            @empty
                <p>Nav pieejamu ceļojumu.</p>
            @endforelse
        </div>
    </div>
</x-layouts.public>