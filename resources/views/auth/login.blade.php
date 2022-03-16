@extends('app.layouts.header')

@section('contents')
<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Login to your account</h2>
                    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <input id="email" type="email" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus placeholder="Email">
                        
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input id="password" type="password" @error('password') is-invalid @enderror" name="password"  autocomplete="current-password" placeholder="Email Address">
                            
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <span>
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                
                            <label for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </span>
                        
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>
                    
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </form>
                    
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>New User Signup!</h2>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <input id="name" type="text" @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <input id="email" type="email" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email Address">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror 

                        <input id="password" type="password" @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

                        @error('password')
                            <span role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Re-Password">
                        <button type="submit" class="btn btn-default">
                            {{ __('Register') }}
                        </button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section>
@endsection

