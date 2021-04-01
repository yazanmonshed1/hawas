<div class="col-md-3 mt-4">
    <div class="card library-card-style">
        <img class="card-img-top {{$class}}"
             src="{{asset('assets/images/'.$image)}}"
             alt="Card image cap">
        <div class="card-body pt-4 text-center">
            <p class="library-card-title mt-1 mb-2"> {{$title}}</p>
            <p class="library-card-text mb-2">{{$text}}</p>
            <div class="btn moreButton mt-4">
                <a href="{{route('insideBook')}}" class="inside-book-button">
                    <span class="moreText">الكتاب من الداخل </span>
                    <span class="moreLeftArrow">
                      <i class="fas fa-long-arrow-alt-left"></i>
                      </span>
                </a>
            </div>
        </div>
    </div>
</div>
