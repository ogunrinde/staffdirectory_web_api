@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="row"></div>
                <div class="card-header" style="background-color: orangered;color: #fff;font-size: 16px;">Register</div>
                <div style="text-align: center;font-weight: bolder;padding:12px;"><h3 class="">Create Account</h3></div>
                <div class="card-body">


                    <form method="POST" action="{{ route('register') }}">
                       @csrf 
                      <div class="form-group">
                        <label for="password" class="">Name</label>
                         <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                      </div>
                      <div class="form-group">
                        <label for="password" class="">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                      </div>
                      <div class="form-group">
                        <label for="password" class="">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                      </div>
                      <div class="form-group">
                        <label for="password" class="">Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                      </div>
                      <!--div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div-->
                          <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary" style="border: 1px solid #790779;background-color:#fff;color:#790779;width: 100%;margin-top: 10px;">
                                        {{ __('Create Account') }}
                                    </button>

                                
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6">

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" style="color:#790779" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
