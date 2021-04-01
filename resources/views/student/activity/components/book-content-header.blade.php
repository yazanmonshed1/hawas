<div class="card card-image-style">
    <div class="card-body pb-0 pr-0 pl-0">
        <div class="container">
            <div class="row card-title text-md-right text-center">
                <div class="col-md-7">
                    <div class="float-right d-inline-block">
                        <img src="{{ asset('storage/' . $book->cover_image) }}" class="book-title-img">
                    </div>
                    <div class="d-inline-block">
                        <p class="m-0 title-of-card pt-md-1 pr-2">{{ $book->title }}</p>
                        <p class="m-0 class-text pr-2">{{ auth()->user()->grade->name }}</p>
                        <p class="class-text pr-2">
                            {{ auth()->user()->grade->school->name }}</p>
                    </div>
                </div>
                <div class="col-md-2 col-5 pt-3 lamp-div text-center mr-md-0 mr-4">
                    <img src="{{ asset('assets/images/platform/idea-lamp.svg') }}">
                    <p class="activity-num pt-1">
                        {{ $book->contents()->where('page_type', 'exercise')->count()
    ? $book->contents()->where('page_type', 'exercise')->count() . ' تمارين'
    : '' }}
                        تمارين
                    </p>
                </div>
                <div class="col-md-2 col-5 pt-3 page-div text-center mr-md-2 mr-1">
                    <img src="{{ asset('assets/images/platform/page.svg') }}">
                    <p class="page-num pt-1">
                        {{ $book->contents->count() ? $book->contents->count() . ' صفحة' : '' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
