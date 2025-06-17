@section('title', 'Mani čeki')

<x-layouts.public class="my-checks-page">
    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-center">Mani čeki</h1>

        <div
            class="bg-orange-50 border border-orange-300 rounded-xl p-5 mb-6 shadow"
        >
            <form method="POST" action="{{ route('my.checks') }}">
                @csrf
                <label
                    for="check_code"
                    class="block text-lg font-semibold text-orange-700 mb-2"
                >
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

        @if ($check)
            <div class="bg-white border rounded-xl shadow p-6 overflow-x-auto">
                <h2 class="text-2xl font-bold text-orange-700 mb-2">
                    {{ $type === 'travel' ? 'Ceļojuma informācija' : 'Pakalpojuma informācija' }}
                </h2>
                @if ($type === 'travel')
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
                    <p>
                        <strong>Cilvēku skaits:</strong>
                        {{ $check->people_count }}
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
                @if ($type === 'travel')
                    <button
                        type="button"
                        class="mt-4 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded font-semibold transition open-modal"
                        data-modal-id="cancel-modal-{{ $check->id }}"
                    >
                        Atcelt pirkumu
                    </button>

                    <div
                        id="cancel-modal-{{ $check->id }}"
                        class="modal opacity-0 pointer-events-none fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
                    >
                        <div class="bg-white p-6 rounded-lg shadow-lg">
                            <p>
                                Vai tiešām vēlaties atcelt ceļojuma pieteikumu?
                            </p>
                            <div class="mt-4 flex justify-end gap-2">
                                <button
                                    class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 w-full rounded confirm-cancel"
                                    data-check-code="{{ $check->code }}"
                                    data-travel-id="{{ $check->travel_id }}"
                                >
                                    Jā
                                </button>
                                <button
                                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 w-full rounded close-modal"
                                    data-modal-id="cancel-modal-{{ $check->id }}"
                                >
                                    Nē
                                </button>
                            </div>
                        </div>
                    </div>
                @elseif ($type === 'service')
                    <button
                        type="button"
                        class="mt-4 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded font-semibold transition open-modal"
                        data-modal-id="cancel-modal-{{ $check->id }}"
                    >
                        Atcelt pirkumu
                    </button>

                    <div
                        id="cancel-modal-{{ $check->id }}"
                        class="modal opacity-0 pointer-events-none fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
                    >
                        <div class="bg-white p-6 rounded-lg shadow-lg">
                            <p>
                                Vai tiešām vēlaties atcelt pakalpojuma pieteikumu?
                            </p>
                            <div class="mt-4 flex justify-end gap-2">
                                <button
                                    class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 w-full rounded confirm-cancel"
                                    data-check-code="{{ $check->code }}"
                                    data-service-id="{{ $check->service_id }}"
                                >
                                    Jā
                                </button>
                                <button
                                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 w-full rounded close-modal"
                                    data-modal-id="cancel-modal-{{ $check->id }}"
                                >
                                    Nē
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @elseif ($check_code)
            <div class="bg-white border rounded-xl shadow p-6">
                <p class="text-red-500">Čeks ar norādīto kodu nav atrasts.</p>
            </div>
        @endif
    </div>

    <script>
        document.querySelectorAll('.open-modal').forEach((button) => {
            button.addEventListener('click', function () {
                const modalId = this.getAttribute('data-modal-id'); // Extracts the modal ID from the button's data attribute
                const openEvent = new CustomEvent('open-modal', {
                    detail: { id: modalId },
                });
                document.dispatchEvent(openEvent); // Dispatches a custom event to open the modal
            });
        });

        document.querySelectorAll('.close-modal').forEach((button) => {
            button.addEventListener('click', function () {
                const modalId = this.getAttribute('data-modal-id'); // Extracts the modal ID from the button's data attribute
                const closeEvent = new CustomEvent('close-modal', {
                    detail: { id: modalId },
                });
                document.dispatchEvent(closeEvent); // Dispatches a custom event to close the modal
            });
        });

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('confirm-cancel')) {
                const checkCode = e.target.getAttribute('data-check-code'); // Retrieves the check code from the button's data attribute
                const travelId = e.target.getAttribute('data-travel-id'); // Retrieves the travel ID from the button's data attribute
                const serviceId = e.target.getAttribute('data-service-id'); // Retrieves the service ID for service cancellations
                fetch('/cancel-check', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // Includes CSRF token for security in POST request
                    },
                    body: JSON.stringify({
                        check_code: checkCode,
                        travel_id: travelId, // Will be null for services
                        service_id: serviceId, // Will be null for travels
                    }),
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            location.reload(); // Refreshes the page on successful cancellation
                        } else {
                            alert(
                                'Kļūda: ' +
                                    (data.message ||
                                        'Neizdevās atcelt pieteikumu.'),
                            );
                        }
                    })
                    .catch((error) => console.error('Error:', error)); // Logs any network or fetch errors to the console
                const modalId = e.target.closest('.modal').id; // Finds the closest modal ancestor to determine its ID
                const closeEvent = new CustomEvent('close-modal', {
                    detail: { id: modalId },
                });
                document.dispatchEvent(closeEvent);
            }
        });
    </script>
</x-layouts.public>