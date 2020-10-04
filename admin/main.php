<?php
    require("cmp/session.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            require("cmp/head.php");
        ?>
        <title>News A2H CMS | Main</title>
    </head>
    <body>
        <div>
            <nav class="navbar navbar-light navbar-expand-md border-light shadow" style="background-color: #42A7DF;">
                <div class="mx-auto order-0">
                    <a class="navbar-brand mx-auto" href="main.php">
                        <img src="../assets/img/ask2human-news.png" />
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                    <ul class="navbar-nav ml-auto" style="margin-right: 100px;">
                        <li class="nav-item active">
                            <a class="nav-link active" href="main.php" style="font-weight: bord; color: #fff;">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="country.php" style="font-weight: bord; color: #fff;">
                                Country
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="category.php" style="font-weight: bord; color: #fff;">
                                Category
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="menu" class="nav-link dropdown-toggle" href="#" id="navbarDropdown"  style="font-weight: bord; color: #fff;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <div class="dropdown-divider"></div>
                                <a href="javascript:change()" class="dropdown-item">My Credentials</a>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:exit()" class="dropdown-item">Exit</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-deck mb-3 text-left">
                        <div class="card mb-4 box-shadow">
                            <div class="card-header">
                                <h4 class="my-0 font-weight-normal">Home Page</h4>
                            </div>
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <div class="col-sm-12">
                                        <div class="list-group">
                                            <p>Welcome to Content Management System for News Ask2Human Website, this CMS allow you manage countries.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            require("cmp/footer.php");
            require("cmp/modal.php");
        ?>
    </body>
    <?php
        require("cmp/script.php");
    ?>
    <!-- Js -->
    <script src="js/main.js"></script>
</html>

