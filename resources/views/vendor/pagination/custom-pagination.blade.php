@if ($paginator->hasPages())
    <nav class="flex items-center justify-around lg:w-1/4 w-3/4 font-inter font-bold">
        <!-- Previous Page Link -->
        @if ($paginator->onFirstPage())
            <span class="text-customblue cursor-not-allowed bg-customgray px-5 py-2 rounded-lg opacity-80">Previous</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="text-white bg-customblue px-5 py-2 rounded-lg opacity-100 hover:bg-blue-950">Previous</a>
        @endif

        <!-- Page Information -->
        <span class="text-customblue">
            {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}
        </span>

        <!-- Next Page Link -->
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="text-white bg-customblue px-5 py-2 rounded-lg opacity-100 hover:bg-blue-950">Next</a>
        @else
            <span class="text-customblue cursor-not-allowed bg-customgray px-5 py-2 rounded-lg opacity-80">Next</span>
        @endif
    </nav>
@endif
