<section class="max-w-6xl mx-auto px-4 sm:px-6 md:px-8 mt-10">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Komentāri:</h2>

    <div class="space-y-6">
        @forelse ($feedbacks as $feedback)
            <div class="bg-white shadow rounded-lg p-4">
                <div class="flex justify-between items-center mb-2">
                    <span class="font-semibold text-gray-800">
                        {{ $feedback->user_name }}
                    </span>
                    <span class="text-sm text-gray-500">
                        {{ $feedback->created_at->format('Y.m.d H:i') }}
                    </span>
                </div>
                <p class="text-gray-700">{{ $feedback->comment }}</p>
            </div>
        @empty
            <p class="text-gray-500">Pagaidām nav komentāru.</p>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $feedbacks->links() }}
    </div>
</section>
