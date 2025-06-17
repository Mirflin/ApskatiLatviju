<div
    class="w-full bg-white text-black p-4 rounded-xl shadow-md space-y-6 max-w-6xl mx-auto my-5"
>
    <form class="space-y-4" method="GET" action="{{ route('services.index') }}">
        <div class="flex flex-col lg:flex-row lg:items-end gap-4">
            <div class="flex flex-col lg:flex-row gap-2">
                <div>
                    <label class="block font-semibold mb-1">Cena (EUR)</label>
                    <input
                        type="number"
                        name="price_min"
                        min="0"
                        placeholder="No"
                        class="w-full border border-orange-300 rounded p-2"
                        value="{{ request('price_min') }}"
                    />
                </div>
                <div class="flex items-end">
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

            <div class="flex-1">
                <label class="block font-semibold mb-1">Nosaukums</label>
                <input
                    type="text"
                    name="name"
                    class="w-full border border-orange-300 rounded p-2"
                    value="{{ request('name') }}"
                    placeholder="Pakalpojuma nosaukums"
                />
            </div>

            <div>
                <label class="block font-semibold mb-1 invisible lg:visible">.</label>
                <button
                    type="submit"
                    class="w-full bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition"
                >
                    Filtrēt
                </button>
            </div>
        </div>
    </form>
</div>
