@php
$extArr = explode('.', $file);
$video = in_array(end($extArr), ['mp4', 'avi', 'wmv', 'wbm', 'flv']) ? true : false;
@endphp
@if ($video)
    <div class="text-center">
        <i class="fa fa-play fa-2x"></i>
        <a class="d-block mt-2" href="{{ asset('storage/' . $file) }}">{{ $file }}</a>
    </div>
@else
    <img src="{{ asset('storage/' . $file) }}" class="d-block m-auto pb-3"
        style="border-radius: 20px; max-height: 200px;max-width: 100%" alt="">
@endif
