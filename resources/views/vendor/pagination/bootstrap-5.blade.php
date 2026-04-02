@if ($paginator->hasPages())
<nav aria-label="Navigasi halaman" style="margin-top: 20px">
    <ul style="display:flex;align-items:center;gap:6px;list-style:none;padding:0;margin:0;flex-wrap:wrap">

        {{-- Tombol Previous --}}
        @if ($paginator->onFirstPage())
            <li>
                <span style="display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:40px;border:1.5px solid var(--border);background:var(--white);color:var(--ink-lt);font-size:.85rem;font-weight:500;cursor:not-allowed;opacity:.5">
                    <i class="bi bi-chevron-left"></i> Sebelumnya
                </span>
            </li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}"
                   style="display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:40px;border:1.5px solid var(--border);background:var(--white);color:var(--ink-mid);font-size:.85rem;font-weight:500;text-decoration:none;transition:all .15s"
                   onmouseover="this.style.borderColor='var(--green)';this.style.color='var(--green)';this.style.background='var(--green-lt)'"
                   onmouseout="this.style.borderColor='var(--border)';this.style.color='var(--ink-mid)';this.style.background='var(--white)'">
                    <i class="bi bi-chevron-left"></i> Sebelumnya
                </a>
            </li>
        @endif

        {{-- Nomor halaman --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <li>
                    <span style="padding:8px 6px;color:var(--ink-lt);font-size:.85rem">···</span>
                </li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li>
                            <span style="display:inline-flex;align-items:center;justify-content:center;width:38px;height:38px;border-radius:10px;background:var(--green);color:white;font-size:.85rem;font-weight:700;font-family:var(--ff-head)">
                                {{ $page }}
                            </span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $url }}"
                               style="display:inline-flex;align-items:center;justify-content:center;width:38px;height:38px;border-radius:10px;border:1.5px solid var(--border);background:var(--white);color:var(--ink-mid);font-size:.85rem;font-weight:500;text-decoration:none;transition:all .15s"
                               onmouseover="this.style.borderColor='var(--green)';this.style.color='var(--green)';this.style.background='var(--green-lt)'"
                               onmouseout="this.style.borderColor='var(--border)';this.style.color='var(--ink-mid)';this.style.background='var(--white)'">
                                {{ $page }}
                            </a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Tombol Next --}}
        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}"
                   style="display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:40px;border:1.5px solid var(--border);background:var(--white);color:var(--ink-mid);font-size:.85rem;font-weight:500;text-decoration:none;transition:all .15s"
                   onmouseover="this.style.borderColor='var(--green)';this.style.color='var(--green)';this.style.background='var(--green-lt)'"
                   onmouseout="this.style.borderColor='var(--border)';this.style.color='var(--ink-mid)';this.style.background='var(--white)'">
                    Berikutnya <i class="bi bi-chevron-right"></i>
                </a>
            </li>
        @else
            <li>
                <span style="display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:40px;border:1.5px solid var(--border);background:var(--white);color:var(--ink-lt);font-size:.85rem;font-weight:500;cursor:not-allowed;opacity:.5">
                    Berikutnya <i class="bi bi-chevron-right"></i>
                </span>
            </li>
        @endif

    </ul>

    {{-- Info halaman --}}
    <p style="margin-top:10px;font-size:.78rem;color:var(--ink-lt)">
        Menampilkan
        <strong>{{ $paginator->firstItem() }}–{{ $paginator->lastItem() }}</strong>
        dari <strong>{{ $paginator->total() }}</strong> data
    </p>
</nav>
@endif