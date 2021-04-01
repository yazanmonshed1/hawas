<div class="row">
    @foreach ($data as $col => $val)
        @if ($col)
            <div class="col-12">
                @if ($col != 'id')
                    <label class="font-weight-bold">{{ __('models.' . $nameSlug . '.columns.' . $col) }}:</label>
                    <p>{{ $val }}</p>
                @endif
            </div>
        @endif
    @endforeach
</div>
