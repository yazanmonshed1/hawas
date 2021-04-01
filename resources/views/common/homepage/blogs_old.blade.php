<!-- Blog Section -->
<section class="section-space">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                @if ($blogs->has(0))
                    <div class="position-relative overflow-hidden h-100">
                        <img src="{{ asset('storage/' . $blogs->get(0)->image) }}" class="h-100 w-100" style="max-height: 480px">
                        <div class="opacity-reading-img-div">
                        </div>
                        <div class="text-div text-md-right text-center pr-4 pl-4">
                            <h4 class="title-gradient">{{ $blogs->get(0)->title }}</h4>
                            <p class="text-gradient">{{ $blogs->get(0)->brief }}</p>
                            <a class="btn moreButton" href="{{ route('blogs.show', [$blogs->get(0)->slug]) }}">
                                <span class="moreText">المزيد</span>
                                <span class="moreLeftArrow">
                                    <i class="fas fa-long-arrow-alt-left"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-md-6 pr-0" style="max-height: 480px">
                <div class="row h-100">
                    @if ($blogs->has(1))
                        <div class="col-md-6 text-md-right text-center col-bg-div">
                            <p class="title-box">{{ $blogs->get(1)->title }}</p>
                            <p class="text-box">{{ $blogs->get(1)->brief }}</p>
                            <a class="btn moreButton" href="{{ route('blogs.show', [$blogs->get(1)->slug]) }}">
                                <span class="moreText">المزيد</span>
                                <span class="moreLeftArrow">
                                    <i class="fas fa-long-arrow-alt-left"></i>
                                </span>
                            </a>
                        </div>
                        <div class="col-md-6 pr-0 pl-0 overflow-hidden">
                            <img src="{{ asset('storage/' . $blogs->get(1)->image) }}" class="h-100 w-100">
                        </div>
                    @endif
                    @if ($blogs->has(2))
                        <div class="col-md-6 pr-0 pl-0 mt-md-0 mt-3 overflow-hidden">
                            <img src="{{ asset('storage/' . $blogs->get(2)->image) }}" class="h-100 w-100">
                        </div>
                        <div class="col-md-6 pl-0 text-md-right text-center col-bg-blue-div">
                            <p class="title-box">{{ $blogs->get(2)->title }}</p>
                            <p class="text-box">{{ $blogs->get(2)->brief }}</p>
                            <a class="btn moreButton" href="{{ route('blogs.show', [$blogs->get(2)->slug]) }}">
                                <span class="moreText">المزيد</span>
                                <span class="moreLeftArrow">
                                    <i class="fas fa-long-arrow-alt-left"></i>
                                </span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6 mt-md-0 mt-3" style="max-height: 480px">
                <div class="row mr-0 h-100">
                    @if ($blogs->has(3))
                        <div class="col-md-6 text-md-right text-center col-bg-orange-div">
                            <p class="title-box">{{ $blogs->get(3)->title }}</p>
                            <p class="text-box">{{ $blogs->get(3)->brief }}</p>
                            <a class="btn moreButton" href="{{ route('blogs.show', [$blogs->get(3)->slug]) }}">
                                <span class="moreText">المزيد</span>
                                <span class="moreLeftArrow">
                                    <i class="fas fa-long-arrow-alt-left"></i>
                                </span>
                            </a>
                        </div>
                        <div class="col-md-6 pr-0 pl-0 overflow-hidden">
                            <img src="{{ asset('storage/' . $blogs->get(3)->image) }}" class="h-100 w-100">
                        </div>
                    @endif
                    @if ($blogs->has(4))
                        <div class="col-md-6 pr-0 pl-0 mt-md-0 mt-3 overflow-hidden">
                            <img src="{{ asset('storage/' . $blogs->get(4)->image) }}" class="h-100 w-100">
                        </div>
                        <div class="col-md-6 pl-0 text-md-right text-center col-bg-div">
                            <p class="title-box">{{ $blogs->get(4)->title }}</p>
                            <p class="text-box">{{ $blogs->get(4)->brief }}</p>
                            <a class="btn moreButton" href="{{ route('blogs.show', [$blogs->get(4)->slug]) }}">
                                <span class="moreText">المزيد</span>
                                <span class="moreLeftArrow">
                                    <i class="fas fa-long-arrow-alt-left"></i>
                                </span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6 pr-0 pl-0 mt-md-0 mt-3">
                @if ($blogs->has(5))
                    <div class="position-relative overflow-hidden h-100">
                        <img src="{{ asset('storage/' . $blogs->get(5)->image) }}" class="h-100 w-100" style="max-height: 480px">
                        <div class="opacity-reading-img-div">
                        </div>
                        <div class="text-div text-md-right text-center pr-4 pl-4">
                            <h4 class="title-gradient">{{ $blogs->get(5)->title }}</h4>
                            <p class="text-gradient">{{ $blogs->get(5)->brief }}</p>
                            <a class="btn moreButton" href="{{ route('blogs.show', [$blogs->get(5)->slug]) }}">
                                <span class="moreText">المزيد</span>
                                <span class="moreLeftArrow">
                                    <i class="fas fa-long-arrow-alt-left"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</section>
