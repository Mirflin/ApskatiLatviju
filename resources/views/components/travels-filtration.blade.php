<div class="w-full bg-white text-black p-4 rounded-xl shadow-md space-y-6 max-w-6xl mx-auto my-5">
    <form class="space-y-4" method="GET" action="{{ route('travels.index') }}">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <label class="block font-semibold mb-1">Cena (EUR)</label>
                <div class="flex gap-2">
                    <input
                        type="number"
                        name="price_min"
                        min="0"
                        placeholder="No"
                        class="w-full border border-orange-300 rounded p-2"
                        value="{{ request('price_min') }}"
                    />
                    <input
                        type="number"
                        name="price_max"
                        min="0"
                        placeholder="Līdz"
                        class="w-full border border-orange-300 rounded p-2"
                        value="{{ request('price_max') }}"
                    />
                </div>
            </div>

            <!-- Sezons -->
            <div>
                <label for="season" class="block font-semibold mb-1">Sezons</label>
                <select
                    id="season"
                    name="season"
                    class="w-full border border-orange-300 rounded p-2"
                >
                    <option value="" {{ request('season') == '' ? 'selected' : '' }}>-- Visi sezoni --</option>
                    <option value="1" {{ request('season') == '1' ? 'selected' : '' }}>Pavasaris</option>
                    <option value="2" {{ request('season') == '2' ? 'selected' : '' }}>Vasara</option>
                    <option value="3" {{ request('season') == '3' ? 'selected' : '' }}>Rudens</option>
                    <option value="4" {{ request('season') == '4' ? 'selected' : '' }}>Ziema</option>
                </select>
            </div>

            <!-- Laika termiņš -->
            <div>
                <label class="block font-semibold mb-1">Laika termiņš</label>
                <div class="flex gap-2">
                    <input
                        type="date"
                        name="date_from"
                        class="w-full border border-orange-300 rounded p-2"
                        value="{{ request('date_from') }}"
                    />
                    <input
                        type="date"
                        name="date_to"
                        class="w-full border border-orange-300 rounded p-2"
                        value="{{ request('date_to') }}"
                    />
                </div>
            </div>
        </div>

        <div class="flex justify-between items-center">
            <button
                type="submit"
                class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition"
            >
                Filtrēt
            </button>

            <button
                type="button"
                id="toggleAdvanced"
                class="hover:underline text-orange-500"
            >
                Vairāk opciju
            </button>
        </div>

        <div id="advancedFilter" class="hidden mt-4 border-t pt-4">
            <h3 class="text-lg font-semibold mb-2">Papildu filtri</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <label class="block font-semibold mb-1">Pilsēta</label>
                    <input
                        type="text"
                        name="city"
                        class="w-full focus-orange-500 border border-orange-300 rounded p-2"
                        placeholder="Rīga, Liepāja, ..."
                        value="{{ request('city') }}"
                    />
                </div>

                <div>
                    <label class="block font-semibold mb-1">Nosaukums</label>
                    <input
                        type="text"
                        name="name"
                        class="w-full border border-orange-300 rounded p-2"
                        placeholder="Сeļojuma nosaukums"
                        value="{{ request('name') }}"
                    />
                </div>

                <div>
                    <label for="spot_count" class="block font-semibold mb-1">
                        Brīvas vietas
                    </label>
                    <input
                        type="number"
                        name="spot_count"
                        min="0"
                        class="w-full border border-orange-300 rounded p-2"
                        value="{{ request('spot_count') }}"
                    />
                </div>
            </div>
        </div>
    </form>
</div>