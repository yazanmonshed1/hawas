{{--@extends('layouts.app')--}}
{{--@section('content')--}}
{{--<div class="container">--}}
    {{-- <div class="row justify-content-center">--}}
        {{-- <div class="col-md-8">--}}
            {{-- <div class="card">--}}
                {{-- <div class="card-header">{{ $title }}</div>
                --}}
                {{-- <div class="card-body">--}}
                    {{-- <form method="POST" action="{{ route($loginRoute) }}">
                        --}}
                        {{-- @csrf--}}
                        {{-- <div class="form-group row">--}}
                            {{-- <label for="username"
                                class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>--}}
                            {{-- <div class="col-md-6">--}}
                                {{-- <input id="username" type="text"
                                    class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                    name="username" value="{{ old('username') }}" required
                                    autofocus>--}}

                                {{-- @if ($errors->has('username'))--}}
                                    {{-- <span class="invalid-feedback"
                                        role="alert">--}}
                                        {{--
                                        <strong>{{ $errors->first('username') }}</strong>--}}
                                        {{-- </span>--}}
                                    {{-- @endif
                                --}}
                                {{-- </div>--}}
                            {{-- </div>--}}
                        {{-- <div class="form-group row">--}}
                            {{-- <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}
                            {{-- <div class="col-md-6">--}}
                                {{-- <input id="password" type="password"
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    name="password" required>--}}

                                {{-- @if ($errors->has('password'))--}}
                                    {{-- <span class="invalid-feedback"
                                        role="alert">--}}
                                        {{--
                                        <strong>{{ $errors->first('password') }}</strong>--}}
                                        {{-- </span>--}}
                                    {{-- @endif
                                --}}
                                {{-- </div>--}}
                            {{-- </div>--}}
                        {{-- <div class="form-group row">--}}
                            {{-- <div class="col-md-6 offset-md-4">
                                --}}
                                {{-- <div class="form-check">
                                    --}}
                                    {{-- <input class="form-check-input" type="checkbox"
                                        name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>--}}

                                    {{-- <label class="form-check-label"
                                        for="remember">--}}
                                        {{--
                                        {{ __('Remember Me') }}--}}
                                        {{-- </label>--}}
                                    {{-- </div>--}}
                                {{-- </div>--}}
                            {{-- </div>--}}
                        {{-- <div class="form-group row mb-0">
                            --}}
                            {{-- <div class="col-md-8 offset-md-4">
                                --}}
                                {{-- <button type="submit"
                                    class="btn btn-primary">--}}
                                    {{-- {{ __('Login') }}--}}
                                    {{-- </button>--}}
                                {{-- @if (Route::has('password.request'))--}}
                                    {{-- <a class="btn btn-link"
                                        href="{{ route($forgotPasswordRoute) }}">--}}
                                        {{--
                                        {{ __('Forgot Your Password?') }}--}}
                                        {{-- </a>--}}
                                    {{-- @endif
                                --}}
                                {{-- </div>--}}
                            {{-- </div>--}}
                        {{-- </form>--}}
                    {{-- </div>--}}
                {{-- </div>--}}
            {{-- </div>--}}
        {{-- </div>--}}
    {{--</div>--}}
{{--@endsection--}}

@extends('admin.layouts.app')

@section('body')
    <div class="home-btn d-none d-sm-block">
        <a href="index.html" class="text-dark"><i class="fas fa-home h2"></i></a>
    </div>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-soft-primary">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary">Welcome Back !</h5>
                                        <p>Sign in to continue to Skote.</p>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="{{ asset('admin/assets/images/profile-img.png') }}" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div>
                                <a href="index.html">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="{{ asset('admin/assets/images/logo.svg') }}" alt=""
                                                class="rounded-circle" height="34">
                                        </span>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2">
                                @if (Session::has('error'))
                                    <div class="alert alert-danger text-center mb-4">{{ Session::get('error') }}</div>
                                @endif
                                <form action="{{ route($loginRoute) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" class="form-control" id="username"
                                            placeholder="{{ __('Enter username') }}" value="{{ old('username') }}">
                                        @error('username')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="userpassword">Password</label>
                                        <input type="password" name="password" class="form-control" id="userpassword"
                                            placeholder="{{ __('Enter password') }}">
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customControlInline">
                                        <label class="custom-control-label"
                                            for="customControlInline">{{ __('Remember me') }}</label>
                                    </div>

                                    <div class="mt-3">
                                        <button class="btn btn-primary btn-block waves-effect waves-light"
                                            type="submit">{{ __('Log In') }}
                                        </button>
                                    </div>

                                    {{-- <div class="mt-4 text-center">
                                        <a href="{{ route('admin.password.request') }}" class="text-muted"><i
                                                class="mdi mdi-lock mr-1"></i>
                                            {{ __('Forgot your password?') }}</a>
                                    </div> --}}
                                </form>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
