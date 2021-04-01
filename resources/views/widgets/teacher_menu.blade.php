@if (auth('teacher')->user()->grade)
    <li>
        <a href="{{ route('admin.teachers.students.index') }}">
            <i class="waves-effect fa fa-users"></i>
            <span>الطلاب</span>
        </a>
    </li>
@endif
<li>
    <a class="has-arrow waves-effect" href="javascript: void(0);" aria-expanded="false">
        <i class="waves-effect fa fa-cog"></i>
        <span>اداء الطلاب</span>
    </a>
    <ul class="sub-menu mm-collapse" aria-expanded="false" style="">
        @isset($books)
            @foreach ($books as $book)
                <li>
                    <a href="{{ route('admin.teachers.students.performance', ['book_id' => $book->id]) }}">
                        <i class="waves-effect fa fa-book"></i>
                        <span>{{ $book->title }}</span>
                    </a>
                </li>
            @endforeach
        @endisset
    </ul>
</li>
