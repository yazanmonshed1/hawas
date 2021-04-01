@extends('admin.layouts.dashboard')

@section('body')

    <h1>{{ __('Build book') . ' ' . $book->title }}</h1>

    {{-- <div class="form-group sections">
        <label>{{ __('Book parts') }}</label>
        <a id="add_new_book_part" href="" class="d-block text-primary">
            <i class="fa fa-plus"></i>
            <span>
                {{ __('admin.add') }}
            </span>
        </a>
        @foreach ($book->parts as $part)
            <th class="d-flex align-items-center">
                {{ $part->title }}
            </th>
            <th>
                <form action="{{ route('admin.text-book-parts.destroy', [$book->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mx-5">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
            </th>
        @endforeach --}}
        {{-- <table class="table table-responsive">
            <thead>
                <tr>
                    <th>{{ __('Title') }}</th>
                    <th>{{ __('admin.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach ($book->parts as $part)
                        <th class="d-flex align-items-center">
                            {{ $part->title }}
                        </th>
                        <th>
                            <form action="{{ route('admin.text-book-parts.destroy', [$book->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mx-5">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </th>
                    @endforeach
                </tr>
            </tbody>
        </table> --}}
    </div>

    {!! $form !!}

@endsection
@section('script')
    @include('admin.scripts.add-edit-script')
    <script>
        var partField = $(
            '<input type="hidden" name="book_text_id" value="{{ $book->id }}"><div class="form-group"><label>{{ __('title') }}</label><input type="text" name="title" class="form-control"></div>'
        )

        $(document).on('click', '#add_new_book_part', function(e) {
            e.preventDefault()
        })

    </script>
@endsection
