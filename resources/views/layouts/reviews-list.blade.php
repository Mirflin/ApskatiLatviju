<div class="mt-10">
    @forelse ($reviews as $review)
        <div class="border-b border-gray-200 py-4">
            <p class="text-gray-700 mb-2">{{ $review->review }}</p>
            <p class="text-sm text-gray-500">
                <strong>Autors:</strong>
                {{ session('anonymous_review_' . $review->client_id) ? 'Anonīms' : ($review->client->name . ' ' . $review->client->surname) }}
            </p>
            <p class="text-sm text-gray-500">
                <strong>Datums:</strong>
                {{ \Carbon\Carbon::parse($review->created_at)->format('d.m.Y H:i') }}
            </p>
        </div>
    @empty
        <p class="text-gray-600">Vēl nav komentāru.</p>
    @endforelse
</div>