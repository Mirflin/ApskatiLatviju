@if (! empty($messages))
    @foreach ($messages as $msg)
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => (show = false), 5000)"
            x-show="show"
            x-transition
            class="fixed right-6 z-[200] bg-white border-l-4 border-orange-400 text-orange-800 px-6 py-4 rounded-lg shadow-lg max-w-xs w-full mb-4"
            style="top: calc(1.5rem + {{ $loop->index * 4.5 }}rem)"
        >
            <div class="flex justify-between items-start space-x-4">
                <div class="flex-1 text-sm">
                    {{ $msg }}
                </div>
                <button
                    @click="show = false"
                    class="text-orange-500 hover:text-orange-700"
                >
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        </div>
    @endforeach
@endif

