@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-3">
                <div class="fxt-header">
                    <a href="{{ route('login') }}" class="fxt-logo"><img src="{{ asset('themes/demo/img/logo-24.png') }}"
                            alt="Logo"></a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="fxt-content">
                    <h2>Recover your password</h2>
                    <div class="fxt-form">

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group">
                                <div class="fxt-transformY-50 fxt-transition-delay-1">
                                    <label for="email"
                                        class=" col-form-label text-white text-md-end">{{ __('Email Address') }}</label>

                                    <div class="">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                          
                            <div class="form-group">
                                <div class="fxt-transformY-50 fxt-transition-delay-4">
                                    <button type="submit" class="fxt-btn-fill">Send Me Email</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="fxt-footer">
                        <div class="fxt-transformY-50 fxt-transition-delay-9">
                            <p>Don't have an account?<a href="{{ route('register') }}"
                                    class="switcher-text2 inline-text">Register</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
