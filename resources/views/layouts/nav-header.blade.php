@php
    $isHome = request()->is('/');
@endphp

<header class="topbar">
    <div class="logo">
        <a href="/">
            <img src="{{ asset('images/logo.png') }}" alt="Logo image" class="logo-img" />
            <span class="logo-text">Apskati Latviju!</span>
        </a>
    </div>
    <button class="burger" aria-label="Toggle menu">
        <i class="fa-solid fa-bars"></i>
    </button>
    <ul class="btn-list hidden-on-load">
        <li>
            @if ($isHome)
                <!-- If on the main page = scroll -->
                <a href="#start-section" id="homeLink"><i class="fa-solid fa-house"></i> Sākums</a>
            @else
                <!-- If on the main page = href -->
                <a href="/"><i class="fa-solid fa-house"></i> Sākums</a>
            @endif
        </li>
        <li><a href="#news-section"><i class="fa-solid fa-bolt"></i> Aktuāls</a></li>
        <li><a href="#travels-section"><i class="fa-solid fa-car"></i> Ceļojumi</a></li>
        <li><a href="#footer-content"><i class="fa-solid fa-circle-info"></i> Par mums</a></li>
    </ul>
</header>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const homeLink = document.getElementById('homeLink');
        if (homeLink) {
            homeLink.addEventListener('click', (e) => {
                e.preventDefault();
                const target = document.querySelector('#start-section');
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        }
    });
</script>
