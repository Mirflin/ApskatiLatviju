@section('title', 'Palīdzība')

<x-layouts.public class="support-page">
    <section class="support-section">
        <div class="form-container border border-orange-300 rounded-3xl">
            <h1 class="text-3xl font-bold text-orange-900 mb-6 text-center">
                Atbalsta saziņa
            </h1>
            <form
                action="{{ route('ticket.submit') }}"
                method="POST"
                class="space-y-6"
            >
                @csrf
                <div>
                    <label
                        for="email"
                        class="block font-semibold text-orange-900 mb-2"
                    >
                        Tava e-pasta adrese
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        placeholder="piemērs@email.com"
                        class="w-full border border-orange-300 rounded-md p-2"
                    />
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label
                        for="message"
                        class="block font-semibold text-orange-900 mb-2"
                    >
                        Tavs komentārs
                    </label>
                    <textarea
                        id="message"
                        name="content"
                        rows="5"
                        required
                        placeholder="Apraksti savu problēmu vai jautājumu..."
                        class="w-full border border-orange-300 rounded-md p-2"
                    >
{{ old('content') }}</textarea
                    >
                    @error('content')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="text-right">
                    <button
                        type="submit"
                        class="bg-orange-600 hover:bg-orange-700 text-white font-semibold px-6 py-2 rounded-md transition"
                    >
                        Nosūtīt ziņu
                    </button>
                </div>
            </form>
        </div>
        <div class="slideshow-container">
            <div id="text-slideshow"></div>
            <img
                src="{{ asset('images/technical_person.png') }}"
                alt="Support Image"
                class="support-image"
            />
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const texts = [
                'Mēs vienmēr esam gatavi palīdzēt jums ar jebkādiem jautājumiem.',
                'Jūsu problēmas risinājums mums ir prioritāte.',
                'Neatkarīgi no situācijas, mēs sniegsim atbalstu un konsultācijas.',
                'Sazinieties ar нами jebkurā laikā — mēs esam blakus.',
                'Jūsu apmierinātība ir mūsu galvenais mērķis.',
            ];
            const slideshow = document.getElementById('text-slideshow');
            let index = 0;

            function showNextText() {
                slideshow.style.opacity = '0';
                slideshow.style.transform = 'translateY(10px)';
                setTimeout(() => {
                    slideshow.textContent = texts[index];
                    index = (index + 1) % texts.length;
                    slideshow.style.opacity = '1';
                    slideshow.style.transform = 'translateY(0)';
                }, 500);
            }

            slideshow.textContent = texts[0];
            slideshow.style.transition =
                'opacity 0.5s ease, transform 0.5s ease';
            slideshow.style.opacity = '1';
            setInterval(showNextText, 5000);
        });
    </script>
</x-layouts.public>
