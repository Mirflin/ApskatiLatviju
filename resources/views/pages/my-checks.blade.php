<x-layouts.public class="my-checks-page">
    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-center">Mani čeki</h1>

        <div class="bg-orange-50 border border-orange-300 rounded-xl p-5 mb-6 shadow">
            <form method="POST" action="{{ route('my.checks') }}">
                @csrf
                <label for="check_code" class="block text-lg font-semibold text-orange-700 mb-2">
                    Ievadi čeka kodu:
                </label>

                <div class="flex flex-col sm:flex-row gap-2">
                    <input
                        type="text"
                        id="check_code"
                        name="check_code"
                        value="{{ old('check_code', $check_code ?? '') }}"
                        class="w-full border border-orange-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400"
                        required
                    />
                    <button
                        type="submit"
                        class="w-full sm:w-auto bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded font-semibold transition"
                    >
                        Meklēt
                    </button>
                </div>
                @error('check_code')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </form>
        </div>

        @if($check)
            <div class="bg-white border rounded-xl shadow p-6 overflow-x-auto">
                <h2 class="text-2xl font-bold text-orange-700 mb-2">
                    {{ $type === 'travel' ? 'Ceļojuma informācija' : 'Pakalpojuma informācija' }}
                </h2>
                @if($type === 'travel')
                    <p>
                        <strong>Nosaukums:</strong>
                        {{ $check->travel->name }}
                    </p>
                    <p>
                        <strong>Pilsēta:</strong>
                        {{ $check->travel->city }}
                    </p>
                    <p>
                        <strong>Cena:</strong>
                        €{{ number_format($check->travel->price, 2, '.', ',') }}
                    </p>
                    <p>
                        <strong>Datums:</strong>
                        {{ $check->travel->formattedTimeTerm('d.m.Y') }}
                    </p>
                    <div>
                        <strong>Apraksts:</strong>
                        <p class="break-words">
                            {{ $check->travel->description }}
                        </p>
                    </div>
                @else
                    <p>
                        <strong>Nosaukums:</strong>
                        {{ $check->service->name }}
                    </p>
                    <p>
                        <strong>Cena:</strong>
                        €{{ number_format($check->service->price, 2, '.', ',') }}
                    </p>
                    <div>
                        <strong>Apraksts:</strong>
                        <p class="break-words">
                            {{ $check->service->description }}
                        </p>
                    </div>
                @endif
                <p class="mt-4">
                    <strong>Čeka kods:</strong>
                    {{ $check->code }}
                </p>
                <p>
                    <strong>Izveidots:</strong>
                    {{ \Carbon\Carbon::parse($check->created_at)->format('d.m.Y H:i') }}
                </p>
            </div>
        @elseif($check_code)
            <div class="bg-white border rounded-xl shadow p-6">
                <p class="text-red-500">Čeks ar norādīto kodu nav atrasts.</p>
            </div>
        @endif
    </div>
</x-layouts.public>