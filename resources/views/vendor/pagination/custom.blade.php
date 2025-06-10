@if ($paginator->hasPages())
    <div class="flex items-center justify-end mt-6">
        <nav class="inline-flex rounded-md shadow-sm" role="navigation" aria-label="Lapas navigācija">
            {{-- Atpakaļ lapa --}}
            @if ($paginator->onFirstPage())
                <span class="px-3 py-1 border border-gray-300 bg-gray-200 text-gray-500 text-sm rounded-l-md cursor-not-allowed">
                    Atpakaļ
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1 border border-orange-500 bg-white text-sm text-orange-600 hover:bg-orange-50 rounded-l-md">
                    Atpakaļ
                </a>
            @endif

            {{-- Numurētās lapas --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-3 py-1 border border-gray-300 bg-white text-sm text-gray-700">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-3 py-1 border border-orange-500 bg-orange-500 text-white text-sm font-semibold">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="px-3 py-1 border border-orange-400 bg-white text-sm text-orange-600 hover:bg-orange-50">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Nākamā lapa --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1 border border-orange-500 bg-white text-sm text-orange-600 hover:bg-orange-50 rounded-r-md">
                    Nākamā
                </a>
            @else
                <span class="px-3 py-1 border border-gray-300 bg-gray-200 text-gray-500 text-sm rounded-r-md cursor-not-allowed">
                    Nākamā
                </span>
            @endif
        </nav>
    </div>
@endif
