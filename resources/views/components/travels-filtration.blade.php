<div class="w-full bg-white text-black p-4 rounded-xl shadow-md space-y-6">
    <form class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Cena no-līdz -->
            <div>
                <label class="block font-semibold mb-1">Cena (EUR)</label>
                <div class="flex gap-2">
                    <input
                        type="number"
                        name="price_min"
                        min="0"
                        placeholder="No"
                        class="w-full border border-orange-300 rounded p-2"
                    />
                    <input
                        type="number"
                        name="price_max"
                        min="0"
                        placeholder="Līdz"
                        class="w-full border border-orange-300 rounded p-2"
                    />
                </div>
            </div>

            <!-- Sezons -->
            <div>
                <label for="season" class="block font-semibold mb-1">
                    Sezons
                </label>
                <select
                    id="season"
                    name="season"
                    class="w-full border border-orange-300 rounded p-2"
                >
                    <option value="">-- Visi sezoni --</option>
                    <option value="pavasaris">Pavasaris</option>
                    <option value="vasara">Vasara</option>
                    <option value="rudens">Rudens</option>
                    <option value="ziema">Ziema</option>
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
                    />
                    <input
                        type="date"
                        name="date_to"
                        class="w-full border border-orange-300 rounded p-2"
                    />
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex justify-between items-center">
            <button
                type="submit"
                class="bg-orange-500 text-white px-6 py-2 rounded-full hover:bg-orange-600 transition"
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

        <!-- Advanced Filter -->
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
                    />
                </div>

                <div>
                    <label class="block font-semibold mb-1">Nosaukums</label>
                    <input
                        type="text"
                        name="name"
                        class="w-full border border-orange-300 rounded p-2"
                        placeholder="Nosaukums..."
                    />
                </div>

                <!-- Pieteikšanās iespēju skaits -->
                <div>
                    <label for="spot_count" class="block font-semibold mb-1">
                        Brīvas vietas
                    </label>
                    <input
                        type="number"
                        name="spot_count"
                        min="0"
                        class="w-full border border-orange-300 rounded p-2"
                    />
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    document.getElementById('toggleAdvanced')?.addEventListener('click', () => {
        const advanced = document.getElementById('advancedFilter');
        if (advanced.classList.contains('hidden')) {
            advanced.classList.remove('hidden');
        } else {
            advanced.classList.add('hidden');
        }
    });
</script>
