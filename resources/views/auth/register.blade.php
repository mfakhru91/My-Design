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
      <div class="card mb-3">
        <div class="card-body card-img">
          <div class="row">
            <div class="col-md-5">
              <div class="imgCard">
                <img src="public\image\form.png" alt="" class="img-fluid img-form">
              </div>
            </div>
            <div class="col-md-7">
              <div class="card-body card-form">
                <img src="\image\salakpondoh.png" alt="" width="200px">
                <br><br>
                <h3>Sign into your account</h3>
                <form method="POST" action="{{ route('register') }}">
                  @csrf
                  <div class="form-group">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email address">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                  </div>
                  <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="password">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confrim password">
                  </div>
                  <br>
                  <button type="submit" class="btn btn-dark btn-block">Submit</button>
                  <p>Do you have account <a href="{{route('login')}}" class="text-secondary" style="text-decoration:none">Sign in </a></p>
                  <small> <a href="#" class="text-secondary">Terms of use. Privacy policy</a> </small>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
