<section id="news-section" class="bg-gray-50 py-10">
    <div class="max-w-6xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-10">Aktuāls</h2>

        <div class="relative overflow-hidden" id="newsSlider">
            <div class="flex transition-transform duration-500" id="newsSlides">
                @foreach ($news as $item)
                    <div class="min-w-full flex flex-col sm:flex-row bg-white rounded-lg shadow-lg p-6 h-[500px]">
                        <img src="{{ $item->image_url }}"
                             alt="{{ $item->header }}"
                             class="w-full sm:w-3/5 h-full object-cover rounded mb-4 sm:mb-0 sm:mr-6" />
                        <div class="sm:w-2/5 flex flex-col justify-between">
                            <div>
                                <h3 class="text-2xl font-semibold mb-4">{{ $item->header }}</h3>
                                <p class="text-gray-700 mb-6">{{ Str::limit($item->paragraph, 250) }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-3">
                                    Publicēts: {{ \Carbon\Carbon::parse($item->created_at)->format('d.m.Y') }}
                                </p>
                                <a href="{{ route('news.details', $item->id) }}"
                                   class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                    Lasīt vairāk
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <button id="prevSlide"
                    class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-black text-white p-2 rounded-full hover:bg-gray-700 z-10">
                &#8592;
            </button>
            <button id="nextSlide"
                    class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-black text-white p-2 rounded-full hover:bg-gray-700 z-10">
                &#8594;
            </button>
        </div>
    </div>

    <script>
        const slides = document.getElementById('newsSlides');
        const totalSlides = {{ count($news) }};
        let currentIndex = 0;

        function updateSlider() {
            slides.style.transform = `translateX(-${100 * currentIndex}%)`;
        }

        document.getElementById('prevSlide').addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
            updateSlider();
        });

        document.getElementById('nextSlide').addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % totalSlides;
            updateSlider();
        });
    </script>
</section>
