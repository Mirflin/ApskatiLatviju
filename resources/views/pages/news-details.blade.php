@section('title', $news->header)

<x-layouts.public>
    <div class="max-w-6xl mx-auto p-6 flex-grow">
        <div class="bg-white rounded-lg shadow-md overflow-hidden p-6 flex flex-col lg:flex-row">
            <div class="lg:w-3/5 lg:pr-8">
                <h1 class="text-3xl font-bold mb-4">
                    {{ $news->header }}
                </h1>
                <p class="text-sm text-gray-500 mb-6">
                    <strong>Publicēts:</strong>
                    {{ \Carbon\Carbon::parse($news->created_at)->format('d.m.Y') }}
                </p>
                <p class="text-gray-800 text-lg leading-relaxed whitespace-pre-line">
                    {{ $news->paragraph }}
                </p>
                <div class="mt-8">
                    <a
                        href="{{ route('news.index') }}"
                        class="inline-block bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300"
                    >
                        ← Atpakaļ
                    </a>
                </div>
            </div>
            <div class="lg:w-2/5 mt-6 lg:mt-0">
                <img
                    src="{{ $news->image_url }}"
                    alt="{{ $news->header }}"
                    class="w-full h-auto max-h-[600px] object-cover rounded-lg"
                />
            </div>
        </div>
    </div>
</x-layouts.public>