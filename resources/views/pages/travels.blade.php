@section('title', 'Ceļojumi')

<x-layouts.public class="travels-page">
    @include('components.travels-filtration')
    <h2 class="text-3xl font-bold mb-6 text-center my-5">Ceļojumi</h2>
    <div class="flex-grow mx-auto p-6 max-w-6xl">
        <div id="travels-container" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            @foreach ($travels as $travel)
                <div class="travel-item border rounded-lg shadow-lg overflow-hidden bg-white" style="display: none;">
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
            @endforeach
            @if(count($travels) === 0)
                <p>Nav pieejamu ceļojumu.</p>
            @endif
        </div>
        
        <div id="js-pagination" class="flex items-center justify-center mt-6" 
            @if(count($travels) <= 3) style="display: none;" @endif>
            <nav class="inline-flex rounded-md shadow-sm" role="navigation" aria-label="Lapas navigācija">
                <button id="prev-page"
                    class="px-4 py-2 border border-orange-500 bg-white text-orange-600 hover:bg-orange-50 rounded-l-md">
                    Atpakaļ
                </button>

                <span class="px-4 py-2 border-t border-b border-orange-400 bg-white text-orange-600" id="current-page">
                    1
                </span>

                <button id="next-page"
                    class="px-4 py-2 border border-orange-500 bg-white text-orange-600 hover:bg-orange-50 rounded-r-md">
                    Nākamā
                </button>
            </nav>
        </div>
    </div>
</x-layouts.public>