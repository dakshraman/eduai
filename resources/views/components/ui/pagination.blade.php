@props(['paginator'])

@if($paginator->hasPages())
    <nav class="flex items-center justify-between">
        <div class="text-sm text-gray-500">
            Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} results
        </div>
        <div class="flex items-center gap-1">
            @if($paginator->onFirstPage())
                <span class="px-3 py-2 text-sm text-gray-400 bg-gray-50 rounded-xl cursor-not-allowed">Previous</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-2 text-sm text-gray-600 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition">Previous</a>
            @endif

            @foreach($elements as $element)
                @if(is_string($element))
                    <span class="px-3 py-2 text-sm text-gray-400">{{ $element }}</span>
                @endif

                @if(is_array($element))
                    @foreach($element as $page => $url)
                        @if($page == $paginator->currentPage())
                            <span class="px-3 py-2 text-sm text-[#1e293b] bg-[#CDC1FF] rounded-xl font-semibold">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-3 py-2 text-sm text-gray-600 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-2 text-sm text-gray-600 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition">Next</a>
            @else
                <span class="px-3 py-2 text-sm text-gray-400 bg-gray-50 rounded-xl cursor-not-allowed">Next</span>
            @endif
        </div>
    </nav>
@endif
