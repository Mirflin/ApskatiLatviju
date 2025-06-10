<div class="max-w-6xl w-full mx-auto p-6 flex-grow">
    <h2 class="text-3xl font-bold mb-10">Komentāri</h2>
    <section>
        <div class="h-full">
            <div>
                <label for="code" class="block font-semibold">
                    Kods (čeka numurs)
                </label>
                <input
                    type="text"
                    id="code"
                    name="code"
                    class="w-full border rounded p-2 border rounded border-orange-300 p-2"
                    required
                />
            </div>
        </div>
        <div>
            <label for="comment" class="block font-semibold mt-5">Komentārs</label>
            <textarea
                name="comment"
                class="w-full border rounded border-orange-300 p-2"
                id="comment"
                rows="5"
                maxlength="255"
            ></textarea>
            <div class="form-check form-switch">
                <div class="flex mb-4">
                    <input
                        id="anonim-checkbox"
                        type="checkbox"
                        value=""
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 light:focus:ring-blue-600 light:ring-offset-gray-800 focus:ring-2 light:bg-gray-700 light:border-gray-600"
                        checked
                    />
                    <label
                        for="anonim-checkbox"
                        class="ms-2 text-sm font-medium text-gray-900 light:text-gray-300 justify-center"
                    >
                        Palikt anonīms
                    </label>
                </div>
            </div>
        </div>
        <button
            type="submit"
            class="text-white px-6 py-2 rounded bg-orange-500 hover:bg-orange-600 transition"
        >
            Komentēt
        </button>
    </section>
    @include('layouts.comments-list')
</div>
