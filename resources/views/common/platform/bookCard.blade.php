<div class="mt-md-0 mt-3 col-md-3">
    <a href="{{ $url }}">
        @if ($media_type == 'image')
            <img src="{{ $intro }}" class="w-100" style="height: 100px">
        @else
            @php
                $extArr = explode('.', $intro);
            @endphp
            <video class="w-100" controls style="height: 100px">
                <source src="{{ $intro }}" type="video/{{ end($extArr) }}">
            </video>
        @endif
        <p class="platform-book-title text-center mt-3">
            {{ strlen($title) > 20 ? mb_substr($title, 0, 20) . '...' : $title }}
        </p>
    </a>
</div>
