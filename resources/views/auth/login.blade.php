<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <link rel="stylesheet" href="{{asset('public\css\bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('public\css\loginregister.css?v')}}">
  <body>
    <div class="container">
      <div class="card ">
        <div class="card-body card-img">
          <div class="row">
            <div class="col-md-5">
              <div class="imgCard">
                <img src="{{asset('public/image/form.png')}}" alt="" class="img-fluid img-form">
              </div>
            </div>
            <div class="col-md-7">
              <div class="card-body card-form">
                <h3>Sign into your account</h3>
                <form method="post" action="{{ route('login') }}">
                  @csrf
                  <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email address">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="*********">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                      <label class="form-check-label" for="remember">
                          {{ __('Remember Me') }}
                      </label>
                  </div>
                  <button type="submit" class="btn btn-dark btn-block">Submit</button>
                </form>
                <br>
                <a href="#" class="text-decoration-none text-secondary">Forgot password?</a>
                <br>
                <p>Don't have an account? <a href="{{route('register')}}" class="text-secondary">Register here</a> </p>
                <br>
                <small> <a href="#" class="text-secondary">Terms of use. Privacy policy</a> </small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
