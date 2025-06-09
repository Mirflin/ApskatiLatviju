<div class="w-full bg-white text-black p-4 rounded-xl shadow-md space-y-6">
    <form method="GET" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
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

            <div>
                <label class="block font-semibold mb-1">Nosaukums</label>
                <input
                    type="text"
                    name="name"
                    class="w-full border border-orange-300 rounded p-2"
                />
            </div>
        </div>

        <div class="flex justify-between items-center">
            <button
                type="submit"
                class="bg-orange-500 text-white px-6 py-2 rounded-full hover:bg-orange-600 transition"
            >
                Filtrēt
            </button>
        </div>
    </form>
</div>
