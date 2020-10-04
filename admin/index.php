<!doctype html>
<html lang="en">
  <head>
    <title>News A2H | Authentication</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel='shortcut icon' type='image/x-icon' href='../assets/img/favicon.png' />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/fontawesome-free-5.13.0-web/css/all.css">
    <!-- User Defined CSS -->
    <link rel="stylesheet" href="css/login.css" />
  </head>
  <body class="text-center">
    <div class="form-signin">
      <div class="login-logo">
        <h4>News A2H | CMS</h4>
      </div>
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">User Authentication</p>
          <form class="user">
            <div class="input-group mb-4">
              <input id="email" type="email" class="form-control" placeholder="E-mail">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-at"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-4">
              <input id="password" type="password" class="form-control" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row form-inline">
              <table style="margin-left: 50%;">
                <tr>
                  <td>
                    <div style="">
                      <a href="forgot-password.php" class="btn btn-warning btn-user btn-block" tabindex="3">Recover</a>
                    </div>
                  </td>
                  <td>
                    <div style="margin-left: 10px;">
                      <a href="javascript:login()" class="btn btn-success btn-user btn-block" tabindex="4">Login</a>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
            <hr />
            <div id="login_state" class="d-flex justify-content-center" role="alert">
            </div>
          </form>
        </div>
      </div>
      <div class="copyright text-center my-auto">
        <hr />
        <span>News - Ask2Human Version 1.0 &copy; All Rights Reserved 2020</span>
      </div>
    </div>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- User Defined    JavaScript -->
    <script src="js/login.js"></script>
  </body>
</html>