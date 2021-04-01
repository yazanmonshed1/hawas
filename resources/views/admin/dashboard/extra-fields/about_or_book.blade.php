<div class="form-group">
    <div class="form-check">
        <input {{$data['book'] ? 'checked' : ''}} id="about_or_book_1" type="radio" name="about_or_book" value="1" class="form-check-input">
        <label for="about_or_book" class="form-check-label">{{ __('Book') }}</label>
    </div>
    <div class="form-check">
        <input {{!$data['book'] ? 'checked' : ''}} id="about_or_book_0" type="radio" name="about_or_book" value="0" class="form-check-input">
        <label for="about_or_book" class="form-check-label">{{ __('About') }}</label>
    </div>
</div>
