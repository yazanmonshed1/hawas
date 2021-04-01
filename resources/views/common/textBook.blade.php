<div class="col-md-3 mt-4">
    <div class="card library-card-style h-100">
        <div class="book-img-card">
            <img class="card-img-top" src="{{ asset('storage/' . $book->front_cover) }}"
                alt="Card image cap" style="height: 185px">
        </div>
        <div class="d-flex flex-column justify-content-between card-body pt-4 text-center">
            <p class="library-card-title mt-1 mb-2"> {{ $book->title }}</p>
            <p class="library-card-text mb-2">{{ mb_strimwidth($book->description, 0, 45, '...') }}</p>
            <div class="btn moreButton">
                <a @auth href="{{ route('library.text.show', [$book->slug]) }}" @endauth @guest
                data-toggle="modal" data-target="#LoginModal" @endguest class="inside-book-button">
                <span class="moreText">الكتاب من الداخل </span>
                <span class="moreLeftArrow">
                    <i class="fas fa-long-arrow-alt-left"></i>
                </span>
            </a>
        </div>
    </div>
</div>
</div>
