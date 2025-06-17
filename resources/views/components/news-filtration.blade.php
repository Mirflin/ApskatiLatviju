<div class="w-full bg-white text-black p-4 rounded-xl shadow-md space-y-6 max-w-6xl mx-auto my-5">
    <form class="space-y-4" method="GET" action="{{ route('news.index') }}">
        <div class="flex flex-col md:flex-row md:items-end gap-4">
            <div class="flex-1">
                <label for="sort" class="block font-semibold mb-1">
                    Kārtot pēc
                </label>
                <select
                    id="sort"
                    name="sort"
                    class="w-full border border-orange-300 rounded p-2"
                >
                    <option value="newest" {{ request('sort') == 'newest' || request('sort') == '' ? 'selected' : '' }}>Jaunākie</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Vecākie</option>
                </select>
            </div>
            <div class="flex-1">
                <label for="search" class="block font-semibold mb-1">
                    Nosaukums
                </label>
                <input
                    type="text"
                    id="search"
                    name="search"
                    class="w-full border border-orange-300 rounded p-2"
                    value="{{ request('search') }}"
                    placeholder="Aktualitātes nosaukums"
                />
            </div>
            <div>
                <button
                    type="submit"
                    class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition"
                >
                    Filtrēt
                </button>
            </div>
        </div>
    </form>
</div>