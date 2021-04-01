<div class="col-md-3 mt-4">
    <div class="card search-card-style h-100">
        <img class="card-img-top {{ $class }}" src="{{ asset('storage/' . $image) }}" alt="Card image cap">
        <div class="card-body p-1 text-center d-flex flex-column justify-content-end">
            <p class="search-card-title mt-1 mb-2">{{ $title }}</p>
            <p class="search-card-text mb-2">{{ $text }}</p>
            <div class="btn moreButton">
                <a href="" class="more-link-button">
                    <span class="moreText">المزيد</span>
                    <span class="moreLeftArrow">
                        <i class="fas fa-long-arrow-alt-left"></i>
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>
