@if (isset($page) && is_array($page))
    <div class="last-page-box pt-2 pb-1">
        <div class="text-center mb-2">
            <p class="m-0 last-page-text">
                آخر صفحة تم فتحها
            </p>
        </div>
        <div class="text-md-right text-center d-inline-block">
            <img src="{{ asset('storage/' . $page['image']) }}" style="max-height: 70px" class="mb-2">
        </div>
        <div class="text-md-right text-center d-inline-block">
            @if ($page)
                <p class="m-0 book-name">
                    {{ $page['title'] }} / {{ $page['subtitle'] }}
                </p>
                <p class="num-page">
                    ص {{ $page['page_number'] }}
                </p>
            @endif
        </div>
    </div>
@endif
