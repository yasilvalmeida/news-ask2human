<!doctype html>
<html lang="en">
  <head>
    <title>News A2H | Recover</title>
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
          <p class="login-box-msg">Recover Password</p>
          <form class="user">
            <div class="input-group mb-4">
              <input id="email" type="text" class="form-control" placeholder="E-mail">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-at"></span>
                </div>
              </div>
            </div>
            <div class="row form-inline">
                <div class="col-6" style="margin-left: 0px; text-align:left;">
                  <a href="index.php" class="btn btn-info btn-user btn-block" tabindex="3">Back</a>
                </div>
                <div class="col-6" style="margin-left: 0px; text-align:right;">
                  <a href="javascript:recover()" class="btn btn-success btn-user btn-block" tabindex="3">Recover</a>
                </div>
            </div>
            <hr />
            <div id="recover_state" class="d-flex justify-content-center" role="alert">
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
    <script src="js/forgot.js"></script>
  </body>
</html>