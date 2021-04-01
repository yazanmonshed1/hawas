<div id="accordion" class="bg-white p-3">
    @foreach ($book->parts as $part)
        <div class="card border">
            <div class="card-header d-flex justify-content-between align-items-center" id="heading-{{ $part->id }}"
                data-toggle="collapse" data-target="#collapse-{{ $part->id }}" aria-expanded="true"
                aria-controls="collapse-{{ $part->id }}" style="cursor: pointer">
                <h5 class="mb-0">
                    {{ $part->title }}
                </h5>
                <div class="d-flex justify-content-end align-items-center">
                    <a text-book-id="{{ $book->id }}" target-id="{{ $part->id }}"
                        class="edit-part-text text-success mx-2">
                        <i class="fa fa-edit fa-2x"></i>
                    </a>
                    <form class="submit_form_via_ajax mx-2"
                        action="{{ route('admin.text-book-parts.destroy', [$part->id]) }}" method="POST"
                        callback="handlePartAddResponse"
                        >
                        @csrf
                        @method('DELETE')
                        <a class="text-danger delete-part">
                            <i class="fa fa-trash fa-2x"></i>
                        </a>
                    </form>
                    <i class="fa fa-chevron-down fa-2x"></i>
                </div>
            </div>

            <div id="collapse-{{ $part->id }}" class="collapse" aria-labelledby="heading-{{ $part->id }}"
                data-parent="#accordion">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <a href="#" class="action-add mb-3" target-id="{{ $part->id }}">
                            <i class="fa fa-plus"></i>
                            <span class="px-2">{{ __('admin.add') . ' ' . __('Text book content') }}</span>
                        </a>
                    </div>
                    <div class="parts-body">
                        @include('admin.text-books.components.part-collapses', ['part' => $part])
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
