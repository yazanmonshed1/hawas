@extends('admin.layouts.dashboard')

@section('body')
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        @foreach ($settings as $tabName => $settingsTab)
            <li class="nav-item">
                <a class="nav-link {{ $tabName == 'site' ? 'active' : '' }}" id="{{ $tabName }}-tab"
                    data-toggle="pill" href="#{{ $tabName }}" role="tab" aria-controls="{{ $tabName }}"
                    aria-selected="true">{{ $tabName }}</a>
            </li>
        @endforeach
    </ul>
    <div class="tab-content" id="pills-tabContent">
        @foreach ($settings as $tabName => $settingsTab)
            <div class="tab-pane fade show {{ $tabName == 'site' ? 'active' : '' }}" id="{{ $tabName }}"
                role="tabpanel" aria-labelledby="{{ $tabName }}-tab">
                <form action="{{ route('admin.settings.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="tabName" value="{{ $tabName }}">
                    @foreach ($settingsTab as $setting)
                        <div class="form-group">
                            <label for="setting-{{ $setting->id }}">{{ __('labels.' . $setting->name) }}</label>
                            <input type="text" value="{{ $setting->value }}" id="setting-{{ $setting->id }}"
                                name="{{ $setting->name }}" class="form-control">
                            <small class="text-info">{{ '@' . "setting('$setting->name')" }}</small>
                        </div>
                    @endforeach
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">{{ __('admin.save') }}</button>
                    </div>
                </form>
            </div>
        @endforeach
    </div>
@endsection
