<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="{{ asset('template/img/logo/logo.png') }}" rel="icon">
  <title>RuangAdmin - Login</title>
  <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('template/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('template/css/ruang-admin.min.css') }}" rel="stylesheet">

</head>
<body class="bg-gradient-login">
  <!-- Login Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <img src="new_logo.jpg" height="180px" width="180px;">
                    <h1 class="h4 text-gray-900 mb-4" style="font-weight: bold">Login</h1>
                  </div>

                  <form class="user" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                        placeholder="Email">
                          @error('email')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                    </div>

                    <div class="form-group">
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"
                       placeholder="Password">
                        @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>

                    <div class="form-group">
                      <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        {{-- <input type="checkbox" class="custom-control-input" id="customCheck"> --}}
                        {{-- <label class="custom-control-label" for="customCheck"> {{ __('Remember Me') }}
                        </label> --}}
                        <label class="form-check-label" for="remember">
                          {{ __('Remember Me') }}
                      </label>
                      </div>
                    </div>

                    <div class="form-group">
                      {{-- <a href="{{ asset ('index.html') }}" class="btn btn-primary btn-block">Login</a> --}}
                      <button type="submit" class="btn btn-primary btn-block" >
                        {{ __('Login') }}
                      </button>

                      {{-- <hr>
                      @if (Route::has('password.request'))
                          <small class="text-center"> 
                            <a class="font-weight-bold small" href="{{ route('password.request') }}">
                              {{ __('Lupa Password Anda?') }}
                            </a>
                          </small>
                      @endif --}}
                    </div>
                    
                    {{-- <a href="{{ asset('index.html') }}" class="btn btn-google btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="index.html" class="btn btn-facebook btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a> --}}
                  </form>
                  {{-- <hr> --}}
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Content -->
  <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('template/js/ruang-admin.min.js') }}"></script>
</body>

</html>