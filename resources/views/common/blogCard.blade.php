<div class="col-md-3 mt-4">
    <div class="card blog-card-style d-flex h-100">
        <img class="card-img-top" src="{{ asset('storage/' . $blog->image) }}" alt="Card image cap">
        <div class="card-body p-1 text-md-right text-center">
            <p class="blog-card-title mt-md-1 mt-3 mb-2">{{ $blog->title }}</p>
            <p class="blog-card-text mb-2">{{ mb_strimwidth($blog->brief, 0, 60, "...") }}</p>
            <a class="btn moreButton" href="{{ route('blogs.show', [$blog->slug]) }}">

                <span class="moreText">المزيد</span>
                <span class="moreLeftArrow mr-2">
                    <i class="fas fa-long-arrow-alt-left"></i>
                </span>
            </a>
        </div>
    </div>
</div>
