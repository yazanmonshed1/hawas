<div class="row">
    @forelse ($data['videos'] as $video)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="channel-item border bg-white h-100 p-3 {{ $video->show ? 'selected' : '' }}"
                id="{{ $video->id }}">
                <i class="fa fa-check fa-2x"></i>
                <img src="{{ $video->thumbnail }}" class="w-100">
                <h5 class="text-center py-2">{{ $video->video_title }}</h5>
            </div>
        </div>
    @empty

    @endforelse
</div>
<input type="hidden" name="videos" id="videos">