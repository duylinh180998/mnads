<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Register</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{('public/frontend/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">
      <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-6 col-md-6">
        <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg-12">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">REGISTER ACCOUNT</h1>
                </div>
                <form class="user" action="{{action('Admin\AdminController@create')}}"  method="post">
                    {{ csrf_field() }}
                   <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-user" name="fullname" id="fullname" placeholder="Fullname">
                  </div>
                  <div class="form-group">
                    <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Email Address">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-user" name="website" id="website" placeholder="Website">
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password">
                    </div>
                    <div class="col-sm-6">
                      <input type="password" class="form-control form-control-user" name="password_confirmation" id="password_confirmation" placeholder="Repeat Password">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary btn-user btn-block" > Register Account</button>
                  @if ($errors->any())
                      <section class="alert alert-danger">
                          <div class="container">
                              <div class="columns is-centered">
                                  <div class="column is-6">
                                      <div class="notification is-danger">
                                          <ul>
                                              @foreach ($errors->all() as $error)
                                                  <li>{{ $error }}</li>
                                              @endforeach
                                          </ul>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </section>
                  @endif
                </form>
                <hr>
                <div class="text-center">
                  <a class="small" href="forgot-password.html">Forgot Password?</a>
                </div>
                <div class="text-center">
                  <a class="small" href="login">Already have an account? Login!</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
