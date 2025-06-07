<section id="travels-section" class="mx-auto">
    <h2 class="text-3xl font-bold mb-6">Ceļojumi</h2>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @forelse ($travels as $travel)
            <div class="border rounded-lg shadow-lg overflow-hidden bg-white">
                <img src="{{ asset('storage/travels/' . $travel->image) }}" alt="{{ $travel->name }}" class="w-full h-78 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold mb-2">{{ $travel->name }} - {{ $travel->country }}</h3>
                    <ul class="text-sm text-gray-600 mb-2">
                        <li><strong>Ilgums:</strong> {{ $travel->formattedTimeTerm() }}</li>
                        <li><strong>Brīvas vietas:</strong> {{ $travel->spot_count }}</li>
                    </ul>
                    <a href="{{ route('travel.details', $travel->id) }}" class="inline-block mt-3 text-blue-500 hover:underline">Lasīt vairāk</a>

                </div>
            </div>
        @empty
            <p>Nav pieejamu ceļojumu.</p>
        @endforelse
    </div>
</section>
