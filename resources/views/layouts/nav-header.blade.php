<header class="topbar">
    <div class="logo">
        <a href="/">
            <img
                src="{{ asset('images/logo.png') }}"
                alt="Logo image"
                class="logo-img"
            />
            <span class="logo-text">Apskati Latviju!</span>
        </a>
    </div>
    <button class="burger" aria-label="Toggle menu">
        <i class="fa-solid fa-bars"></i>
    </button>
    <ul class="btn-list hidden-on-load">
        <li>
            <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i>
                Sākums
            </a>
        </li>
        <li>
            <a
                href="{{route('my.checks')}}"
                class="{{ request()->is('my-checks*') ? 'active' : '' }}"
            >
                <i class="fa-solid fa-meteor"></i>
                Mani čeki
            </a>
        </li>
        <li>
            <a
                href="{{route('news.index')}}"
                class="{{ request()->is('news*') ? 'active' : '' }}"
            >
                <i class="fa-solid fa-fire"></i>
                Aktualitātes
            </a>
        </li>
        <li>
            <a
                href="{{route('travels.index')}}"
                class="{{ request()->is('travels*') ? 'active' : '' }}"
            >
                <i class="fa-solid fa-car"></i>
                Ceļojumi
            </a>
        </li>
        <li>
            <a
                href="{{route('services.index')}}"
                class="{{ request()->is('services*') ? 'active' : '' }}"
            >
                <i class="fa-solid fa-bell-concierge"></i>
                Pakalpojumi
            </a>
        </li>
        <li>
            <a
                href="{{route('about')}}"
                class="{{ request()->is('about*') ? 'active' : '' }}"
            >
                <i class="fa-solid fa-circle-info"></i>
                Par mums
            </a>
        </li>
    </ul>
</header>
