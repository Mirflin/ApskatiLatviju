<div class="max-w-6xl w-full mx-auto p-6 flex-grow">
    <h2 class="text-3xl font-bold mb-10">Komentāri</h2>
    <section>
        <form action="{{ route('travel.review.store', $travel->id) }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="code" class="block font-semibold">
                    Kods (čeka numurs)
                </label>
                <input
                    type="text"
                    id="code"
                    name="code"
                    class="w-full border rounded p-2 border-orange-300"
                    required
                />
                @error('code')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="review" class="block font-semibold mt-5">Komentārs</label>
                <textarea
                    name="review"
                    class="w-full border rounded border-orange-300 p-2"
                    id="review"
                    rows="5"
                    maxlength="255"
                    required
                ></textarea>
                @error('review')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-check form-switch">
                <div class="flex mb-4">
                    <input
                        id="anonim-checkbox"
                        type="checkbox"
                        name="is_anonymous"
                        value="1"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500"
                    />
                    <label
                        for="anonim-checkbox"
                        class="ms-2 text-sm font-medium text-gray-900"
                    >
                        Palikt anonīms
                    </label>
                </div>
            </div>
            <button
                type="submit"
                class="text-white px-6 py-2 rounded bg-orange-500 hover:bg-orange-600 transition"
            >
                Komentēt
            </button>
        </form>
    </section>
    @include('layouts.reviews-list', ['reviews' => $reviews])
    <div id="js-pagination" class="flex items-center justify-center mt-6" 
        <nav class="inline-flex rounded-md shadow-sm" role="navigation" aria-label="Lapas navigācija">
            <button id="prev-page" class="px-3 py-1 border border-orange-500 bg-white text-sm text-orange-600 hover:bg-orange-50 rounded-l-md">
                Atpakaļ
            </button>
            <span class="px-3 py-1 border-t border-b border-orange-400 bg-white text-sm text-orange-600" id="current-page">
                1
            </span>
            <button id="next-page" class="px-3 py-1 border border-orange-500 bg-white text-sm text-orange-600 hover:bg-orange-50 rounded-r-md">
                Nākamā
            </button>
        </nav>
    </div>
</div>