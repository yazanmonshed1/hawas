<div class="col-md-3 mt-4">
    <div class="card library-card-style h-100">
        <div class="video-img-card">
            @if ($book->media_type == 'image')
                <img class="card-img-top" src="{{ asset('storage/' . $book->intro) }}" alt="Card image cap"
                    style="height: 150px">
            @else
                @php
                    $extArr = explode('.', $book->intro);
                @endphp
                <video class="w-100" style="height: 150px" controls>
                    <source src="{{ asset('storage/' . $book->intro) }}" type="video/{{ end($extArr) }}">
                </video>
            @endif
        </div>
        <div class="card-body pt-4 text-center d-flex flex-column justify-content-between">
            <p class="library-card-title mt-1 mb-2">
                {{ strlen($book->title) > 20 ? mb_substr($book->title, 0, 20) . '...' : $book->title }}
            </p>
            <p class="library-card-text mb-2">{{ strlen($book->description) > 60 ? substr($book->description, 0, 60) . '...' : $book->description }}</p>
            <div class="btn moreButton">
                <a class="inside-book-button" @guest data-toggle="modal" data-target="#LoginModal" @endguest @auth
                href="{{ route('my-books') }}" @endauth>
                <span class="moreText">الكتاب من الداخل</span>
                <span class="moreLeftArrow">
                    <i class="fas fa-long-arrow-alt-left"></i>
                </span>
            </a>
        </div>
    </div>
</div>
</div>
