@extends('layouts.app')
@section('content')
    <!-- Video Area Start Here -->
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-3 col-12">
                <div class="fxt-header">
                    <a href="login-24.html" class="fxt-logo"><img src="{{ asset('themes/demo/img/logo-24.png') }}"
                            alt="Logo"></a>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="fxt-content">
                    <h2>Register for new account</h2>
                    <div class="fxt-form">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <div class="fxt-transformY-50 fxt-transition-delay-1">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" placeholder="Name" required autocomplete="name"
                                        autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="fxt-transformY-50 fxt-transition-delay-1">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" placeholder="Email" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="fxt-transformY-50 fxt-transition-delay-2">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        placeholder="****" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <i toggle="#password" class="fa fa-fw fa-eye toggle-password field-icon"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="fxt-transformY-50 fxt-transition-delay-2">
                              
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" placeholder="Comfirm Password" required
                                            autocomplete="new-password">
                                    </div>
                                    <i toggle="#password" class="fa fa-fw fa-eye toggle-password field-icon"></i>
                             
                            </div>

                            <div class="form-group">
                                <div class="fxt-transformY-50 fxt-transition-delay-4">
                                    <button type="submit" class="fxt-btn-fill">Register</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="fxt-footer">
                        <div class="fxt-transformY-50 fxt-transition-delay-9">
                            <p>Already have an account?<a href="{{ route('login') }}" class="switcher-text2 inline-text">Log
                                    in</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
