<x-layouts.public class="news-page">
    @include('components.news-filtration')
    <h2 class="text-3xl font-bold mb-6 text-center my-5">Ziņas</h2>
    <div class="flex-grow mx-auto p-6 max-w-6xl">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            @forelse ($news as $item)
                <div
                    class="border rounded-lg shadow-lg overflow-hidden bg-white"
                >
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
            @empty
                <p>Nav pieejamu ziņu.</p>
            @endforelse
        </div>
    </div>
</x-layouts.public>
