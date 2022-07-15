<html lang="en"><head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>{{ ucfirst($page) }}</title>
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
    <link rel="manifest" href="{{ asset('assets/favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('assets/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendors styles-->
    <link rel="stylesheet" href="{{ asset('vendors/simplebar/css/simplebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendors/simplebar.css') }}">
    <!-- Main styles for this application-->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  </head>
  <body>
    <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="card-group d-block d-md-flex row">
              @if($page == 'login')
              <div class="card col-md-7 p-4 mb-0">
                <div class="card-body">
                    @if ($errors->any())
                          <div class="alert alert-danger">
                              <ul>
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                      @endif
                  
                      <h1>Login</h1>
                      <p class="text-medium-emphasis">Sign In to your account</p>
                      @if(session('status'))
                      <div class="alert alert-danger">
                          {{ session('status') }}
                      </div>
                      @endif
                      <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="input-group mb-3"><span class="input-group-text">
                            <svg class="icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                            </svg></span>
                            <input class="form-control" type="text" name="email" placeholder="Email">
                        </div>
                        <div class="input-group mb-4"><span class="input-group-text">
                            <svg class="icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                            </svg></span>
                            <input class="form-control" type="password" name="password" placeholder="Password">
                        </div>
                        <div class="row">
                            <div class="col-6">
                            <button class="btn btn-primary px-4" type="submit">Login</button>
                            </div>
                            <div class="col-6 text-end">
                            <button class="btn btn-link px-0" type="button">Forgot password?</button>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
              <div class="card col-md-5 text-white bg-primary py-5">
                <div class="card-body text-center">
                  <div>
                    <h2>Sign Up</h2>
                    <p>Create New Account Here</p>
                    <a href="{{ url('register') }}" class="btn btn-lg btn-outline-light mt-3" type="button">SignUp Here!</a>
                  </div>
                </div>
              </div>
              @else
              <div class="card col-md-7 p-4 mb-0">
                <div class="card-body">
                    @if ($errors->any())
                          <div class="alert alert-danger">
                              <ul>
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                      @endif
                    <h1>Register</h1>
                    <p class="text-medium-emphasis">Create your account</p>
                    @if(session('status'))
                      <div class="alert alert-success">
                          {{ session('status') }}
                      </div>
                    @endif
                    <form action="{{ route('register') }}" method="post">
                      @csrf
                      <div class="input-group mb-3"><span class="input-group-text">
                          <svg class="icon">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>

                          </svg></span>
                        <input class="form-control" type="text" name="username" placeholder="Username" value="{{ old('username') }}">
                      </div>
                      <div class="input-group mb-3"><span class="input-group-text">
                          <svg class="icon">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                          </svg></span>
                        <input class="form-control" type="text" name="email" placeholder="Email" value="{{ old('email') }}">
                      </div>
                      <div class="input-group mb-3"><span class="input-group-text">
                          <svg class="icon">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                          </svg></span>
                        <input class="form-control" type="password" name="password" placeholder="Password">
                      </div>
                      <div class="input-group mb-4"><span class="input-group-text">
                          <svg class="icon">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                          </svg></span>
                        <input class="form-control" type="password" name="password_confirmation" placeholder="Repeat password">
                      </div>
                      <button class="btn btn-block btn-success" type="submit">Create Account</button>
                  </form>
                
                </div>
              </div>
              <div class="card col-md-5 text-white bg-primary py-5">
                <div class="card-body text-center">
                  <div>
                    <h2>Login</h2>
                    <p>Already Have Account?</p>
                    <a href="{{ url('login') }}" class="btn btn-lg btn-outline-light mt-3" type="button">Login Here!</a>
                  </div>
                </div>
              </div>

              @endif
            </div>
          </div>
      </div>
    </div>

    <style>
        ol, ul, dl{
            margin-bottom: 0;
        }
    </style>
    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('vendors/@coreui/coreui/js/coreui.bundle.min.js') }}"></script>
    <script src="{{ asset('vendors/simplebar/js/simplebar.min.js') }}"></script>
  
</body>
</html>