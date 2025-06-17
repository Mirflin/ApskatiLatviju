@section('title', 'Aktualitātes')

<x-layouts.public class="news-page">
    @include('components.news-filtration')
    <h2 class="text-3xl font-bold mb-6 text-center my-5">Aktualitātes</h2>
    <div class="flex-grow mx-auto p-6 max-w-6xl">
        <div id="news-container" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            @foreach ($news as $item)
                <div class="news-item border rounded-lg shadow-lg overflow-hidden bg-white" style="display: none;">
                    <img
                        src="{{ $item->image_url }}"
                        alt="{{ $item->header }}"
                        class="w-full h-78 object-cover"
                    />
                    <div class="p-4">
                        <h3 class="text-xl font-semibold mb-2">
                            {{ $item->header }}
                        </h3>
                        <ul class="text-sm text-gray-600 mb-2">
                            <li>
                                <strong>Publicēts:</strong>
                                {{ \Carbon\Carbon::parse($item->created_at)->format('d.m.Y') }}
                            </li>
                        </ul>
                        <p class="text-gray-700 text-sm mb-4 break-words">
                            {{ Str::limit($item->paragraph, 150) }}
                        </p>
                        <a
                            href="{{ route('news.details', $item->id) }}"
                            class="inline-block mt-3 text-orange-500 hover:underline"
                        >
                            Lasīt vairāk
                        </a>
                    </div>
                </div>
            @endforeach
            @if(count($news) === 0)
                <p>Nav pieejamu ziņu.</p>
            @endif
        </div>
        
        <div id="js-pagination" class="flex items-center justify-center mt-6" 
            @if(count($news) <= 3) style="display: none;" @endif>
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