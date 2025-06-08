<section id="news-section" class="bg-gray-50 py-10">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-10">Aktuāls</h2>

        <div class="relative overflow-hidden" id="newsSlider">
            <div class="flex transition-transform duration-500" id="newsSlides">
                @foreach ($news as $item)
                    <div class="min-w-full flex flex-col lg:flex-row bg-white rounded-lg shadow-lg p-4 sm:p-6 h-auto lg:h-[500px]">
                        <img src="{{ $item->image_url }}"
                             alt="{{ $item->header }}"
                             class="w-full lg:w-3/5 h-60 sm:h-80 lg:h-full object-cover rounded mb-4 lg:mb-0 lg:mr-6" />
                        <div class="lg:w-2/5 flex flex-col justify-between">
                            <div>
                                <h3 class="text-xl sm:text-2xl font-semibold mb-2 sm:mb-4">{{ $item->header }}</h3>
                                <p class="text-gray-700 text-sm sm:text-base mb-4 sm:mb-6 break-words">
                                    {{ Str::limit($item->paragraph, 250) }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-2 sm:mb-3">
                                    <strong>Publicēts:</strong> {{ \Carbon\Carbon::parse($item->created_at)->format('d.m.Y') }}
                                </p>
                                <a href="{{ route('news.details', $item->id) }}"
                                   class="inline-block bg-blue-500 text-white text-sm sm:text-base px-4 py-2 rounded hover:bg-blue-600">
                                    Lasīt vairāk
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <button id="prevSlide"
                    class="absolute top-1/2 left-2 sm:left-4 transform -translate-y-1/2 bg-black text-white p-2 sm:p-3 rounded-full hover:bg-gray-700 z-10">
                &#8592;
            </button>
            <button id="nextSlide"
                    class="absolute top-1/2 right-2 sm:right-4 transform -translate-y-1/2 bg-black text-white p-2 sm:p-3 rounded-full hover:bg-gray-700 z-10">
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
