<x-layouts.public>
    <div class="flex w-full relative h-full">
        <div class="absolute inset-0">
            <img
                src="{{ asset('images/riga_views.jpg') }}"
                alt="Riga"
                class="w-full h-full object-cover"
            />
        </div>

        <div
            class="relative z-10 w-full lg:w-1/2 flex items-center justify-center p-8"
        >
            <div
                class="absolute inset-0 rounded-xl"
                style="
                    background: linear-gradient(
                        90deg,
                        rgba(255, 119, 0, 0.275),
                        rgba(249, 116, 22, 0)
                    );
                    backdrop-filter: blur(1px);
                "
            ></div>

            <div
                class="relative w-full max-w-md bg-orange-50 bg-opacity-80 p-6 rounded-xl shadow-lg"
            >
                <h1 class="text-2xl font-bold mb-6 text-orange-900 text-center">
                    Atbalsta saziņa
                </h1>

                <form
                    action="{{ route('ticket.submit') }}"
                    method="POST"
                    class="space-y-4"
                >
                    @csrf

                    <div>
                        <label
                            for="email"
                            class="block font-semibold text-orange-900"
                        >
                            Tava e-pasta adrese:
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            placeholder="piemērs@email.com"
                            class="w-full border border-orange-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400"
                        />
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label
                            for="message"
                            class="block font-semibold text-orange-900"
                        >
                            Tavs komentārs:
                        </label>
                        <textarea
                            id="message"
                            name="content"
                            rows="5"
                            required
                            placeholder="Apraksti savu problēmu vai jautājumu..."
                            class="w-full border border-orange-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400"
                        ></textarea>
                        @error('content')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="text-right">
                        <button
                            type="submit"
                            class="bg-orange-600 hover:bg-orange-700 text-white font-semibold px-6 py-2 rounded transition"
                        >
                            Nosūtīt ziņu
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div
            class="hidden lg:flex lg:w-1/2 relative z-10 flex-col items-center justify-start p-12 rounded-xl"
        >
            <div
                id="text-slideshow"
                class="bg-white max-w-md p-6 rounded-lg shadow-md text-center text-gray-700 text-lg font-semibold leading-relaxed transition-opacity duration-700 opacity-100"
            >
                {{-- text slideshow --}}
            </div>
            <img
                src="{{ asset('images/technical_person.png') }}"
                alt="Support Image"
                class="pers-image mb-6 rounded-lg object-contain"
            />
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const texts = [
                'Mēs vienmēr esam gatavi palīdzēt jums ar jebkādiem jautājumiem.',
                'Jūsu problēmas risinājums mums ir prioritāte.',
                'Neatkarīgi no situācijas, mēs sniegsim atbalstu un konsultācijas.',
                'Sazinieties ar mums jebkurā laikā — mēs esam blakus.',
                'Jūsu apmierinātība ir mūsu galvenais mērķis.',
            ];

            const slideshow = document.getElementById('text-slideshow');
            let index = 0;

            slideshow.style.opacity = 0;
            slideshow.style.transform = 'scale(0.8)';

            function showNextText() {
                slideshow.style.transition =
                    'opacity 1s ease, transform 1s ease';
                slideshow.style.opacity = 0;
                slideshow.style.transform = 'scale(0.8)';

                setTimeout(() => {
                    // Меняем текст
                    slideshow.textContent = texts[index];
                    index = (index + 1) % texts.length;

                    // Плавно показываем с масштабом 1
                    slideshow.style.opacity = 1;
                    slideshow.style.transform = 'scale(1)';
                }, 1000);
            }

            setTimeout(() => {
                slideshow.textContent = texts[0];
                index = 1;

                slideshow.style.transition =
                    'opacity 1s ease, transform 1s ease';
                slideshow.style.opacity = 1;
                slideshow.style.transform = 'scale(1)';

                setInterval(showNextText, 7000);
            }, 1000);
        });
    </script>
</x-layouts.public>
