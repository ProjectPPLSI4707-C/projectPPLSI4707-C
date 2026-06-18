@if ($paginator->hasPages())
<nav class="skoter-pagination" role="navigation" aria-label="Pagination Navigation">

    {{-- Info text --}}
    <span class="pg-info">
        @if ($paginator->firstItem())
            {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} dari {{ $paginator->total() }}
        @else
            {{ $paginator->count() }} data
        @endif
    </span>

    <div class="pg-links">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span class="pg-btn disabled" aria-disabled="true" aria-label="Sebelumnya">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
                <span class="pg-btn-text">Prev</span>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="pg-btn" aria-label="Sebelumnya">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
                <span class="pg-btn-text">Prev</span>
            </a>
        @endif

        {{-- Page Numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="pg-num pg-ellipsis">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="pg-num active" aria-current="page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="pg-num" aria-label="Halaman {{ $page }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="pg-btn" aria-label="Selanjutnya">
                <span class="pg-btn-text">Next</span>
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        @else
            <span class="pg-btn disabled" aria-disabled="true" aria-label="Selanjutnya">
                <span class="pg-btn-text">Next</span>
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </span>
        @endif

    </div>
</nav>

<style>
/* ── SKOTER Pagination ─────────────────────────────── */
.skoter-pagination {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 20px;
}
.pg-info {
    font-size: 12.5px;
    color: var(--gray-500);
    margin-right: auto;
    white-space: nowrap;
}
.pg-links {
    display: flex;
    align-items: center;
    gap: 4px;
    flex-wrap: wrap;
}

/* Prev / Next buttons */
.pg-btn {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 0 14px;
    height: 36px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    border: 1.5px solid var(--gray-200);
    color: var(--gray-500);
    text-decoration: none;
    background: transparent;
    transition: all .18s ease;
    cursor: pointer;
    white-space: nowrap;
}
.pg-btn:hover {
    border-color: var(--primary);
    color: var(--primary);
    background: var(--gold-light);
}
.pg-btn.disabled {
    opacity: 0.4;
    cursor: not-allowed;
    pointer-events: none;
}
.pg-btn-text {
    font-size: 12.5px;
}

/* Page number pills */
.pg-num {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 36px;
    height: 36px;
    padding: 0 6px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 500;
    border: 1.5px solid var(--gray-200);
    color: var(--gray-500);
    text-decoration: none;
    background: transparent;
    transition: all .18s ease;
}
a.pg-num:hover {
    border-color: var(--primary);
    color: var(--primary);
    background: var(--gold-light);
}
.pg-num.active {
    background: var(--primary);
    border-color: var(--primary);
    color: #070e1a;
    font-weight: 700;
    box-shadow: 0 3px 10px rgba(245,166,35,.25);
}
.pg-num.pg-ellipsis {
    border-color: transparent;
    background: transparent;
    color: var(--gray-400);
    min-width: 24px;
    font-size: 16px;
    letter-spacing: 1px;
}

@media (max-width: 480px) {
    .pg-btn-text { display: none; }
    .pg-btn { padding: 0 10px; }
    .skoter-pagination { justify-content: center; }
    .pg-info { width: 100%; text-align: center; margin-right: 0; }
}
</style>
@endif
