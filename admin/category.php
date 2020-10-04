<?php
    require("cmp/session.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            require("cmp/head.php");
        ?>
        <title>News A2H CMS | Categories</title>
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
                        <li class="nav-item">
                            <a class="nav-link" href="main.php" style="font-weight: bord; color: #fff;">
                                Home
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link active" href="country.php" style="font-weight: bord; color: #fff;">
                                Country
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link active" href="category.php" style="font-weight: bord; color: #fff;">
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
                                <h4 class="my-0 font-weight-normal">Category Page</h4>
                            </div>
                            <div class="card-body">
                                <div class="card-body">
                                    <div class="row">
                                        <br>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-auto">
                                            <!-- Begin Level Loader -->
                                            <div class="card-deck mb-3 text-left">
                                                <div class="col-sm-12">
                                                    <table class="table table-responsive table-striped">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th scope="col">Code</th>
                                                                <th scope="col">Name</th>
                                                                <th scope="col"><i class="far fa-check-square"></i></th>
                                                                <th scopre="col" style="text-align: center;"><i class='far fa-edit'></i></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="category-content">
                                                            <!-- Load using AJAX -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- End Level Loader -->
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
        <!-- Begin Category Dialog -->
        <!-- Insert Modal-->
        <div class="modal fade" id="category-insert-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New category</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="category-insert-form">
                            <table style="width: 430px">
                                <tr>
                                    <td>
                                        <label for="_code">Code</label>
                                    </td>
                                    <td>
                                        <input id="_code" type="text" class="form-control form-control-user" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="_name">Name</label>
                                    </td>
                                    <td>
                                        <input id="_name" type="text" class="form-control form-control-user" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="_state">Active/Inactive</label>
                                    </td>
                                    <td>
                                        <input id="_state" type="checkbox" class="form-control form-control-user" />
                                    </td>
                                </tr>
                            </table>
                            <hr />
                            <div id="category-insert-state" class="" role="alert">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-success" href="javascript:category_insert_async()">Save</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Update Modal-->
        <div class="modal fade" id="category-update-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update category</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="category-update-form">
                            <table style="width: 430px">
                                <tr>
                                    <td colspan="2">
                                        <input type="hidden" id="category-update-id" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="code">Code</label>
                                    </td>
                                    <td>
                                        <input id="code" disabled type="text" class="form-control form-control-user" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="name">Name</label>
                                    </td>
                                    <td>
                                        <input id="name" type="text" class="form-control form-control-user" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="state">Active/Inactive</label>
                                    </td>
                                    <td>
                                        <input id="state" type="checkbox" class="form-control form-control-user" />
                                    </td>
                                </tr>
                            </table>
                            <hr />
                            <div id="category-update-state" class="" role="alert">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-success" href="javascript:category_update_async()">Update</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Category Dialog -->
    </body>
    <?php
        require("cmp/script.php");
    ?>
    <!-- Js -->
    <script src="js/main.js"></script>
    <script src="js/category.js"></script>
</html>

