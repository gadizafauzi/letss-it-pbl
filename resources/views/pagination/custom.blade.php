@if ($paginator->hasPages())
<div style="
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    flex-wrap: wrap;
    width: 100%;
">

    {{-- INFO --}}
    <p class="hidden sm:block" style="font-size:13px;color:#64748b;margin:0;">
        Menampilkan
        <strong style="color:#1e293b;font-weight:700;">{{ $paginator->firstItem() }}</strong>–<strong style="color:#1e293b;font-weight:700;">{{ $paginator->lastItem() }}</strong>
        dari
        <strong style="color:#1e293b;font-weight:700;">{{ $paginator->total() }}</strong>
        data
    </p>

    {{-- LINKS --}}
    <div style="display:flex;align-items:center;gap:4px;">

        {{-- PREV --}}
        @if ($paginator->onFirstPage())
            <span style="min-width:36px;height:36px;padding:0 10px;border-radius:10px;font-size:13px;font-weight:600;display:inline-flex;align-items:center;justify-content:center;border:1.5px solid #e2e8f0;background:#f8fafc;color:#cbd5e1;cursor:not-allowed;">
                &#8592;
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" style="min-width:36px;height:36px;padding:0 10px;border-radius:10px;font-size:13px;font-weight:600;display:inline-flex;align-items:center;justify-content:center;border:1.5px solid #e2e8f0;background:#f8fafc;color:#475569;text-decoration:none;transition:all .15s;" onmouseover="this.style.background='#eff6ff';this.style.borderColor='#bfdbfe';this.style.color='#2563eb';" onmouseout="this.style.background='#f8fafc';this.style.borderColor='#e2e8f0';this.style.color='#475569';">
                &#8592;
            </a>
        @endif

        {{-- PAGE NUMBERS --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span style="min-width:36px;height:36px;padding:0 10px;border-radius:10px;font-size:13px;font-weight:600;display:inline-flex;align-items:center;justify-content:center;border:1.5px solid #e2e8f0;background:#f8fafc;color:#94a3b8;">
                    ...
                </span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span style="min-width:36px;height:36px;padding:0 10px;border-radius:10px;font-size:13px;font-weight:700;display:inline-flex;align-items:center;justify-content:center;border:1.5px solid #2563eb;background:#2563eb;color:#fff;">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" style="min-width:36px;height:36px;padding:0 10px;border-radius:10px;font-size:13px;font-weight:600;display:inline-flex;align-items:center;justify-content:center;border:1.5px solid #e2e8f0;background:#f8fafc;color:#475569;text-decoration:none;transition:all .15s;" onmouseover="this.style.background='#eff6ff';this.style.borderColor='#bfdbfe';this.style.color='#2563eb';" onmouseout="this.style.background='#f8fafc';this.style.borderColor='#e2e8f0';this.style.color='#475569';">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- NEXT --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" style="min-width:36px;height:36px;padding:0 10px;border-radius:10px;font-size:13px;font-weight:600;display:inline-flex;align-items:center;justify-content:center;border:1.5px solid #e2e8f0;background:#f8fafc;color:#475569;text-decoration:none;transition:all .15s;" onmouseover="this.style.background='#eff6ff';this.style.borderColor='#bfdbfe';this.style.color='#2563eb';" onmouseout="this.style.background='#f8fafc';this.style.borderColor='#e2e8f0';this.style.color='#475569';">
                &#8594;
            </a>
        @else
            <span style="min-width:36px;height:36px;padding:0 10px;border-radius:10px;font-size:13px;font-weight:600;display:inline-flex;align-items:center;justify-content:center;border:1.5px solid #e2e8f0;background:#f8fafc;color:#cbd5e1;cursor:not-allowed;">
                &#8594;
            </span>
        @endif

    </div>

</div>
@endif
