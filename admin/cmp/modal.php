<!-- Logout Modal-->
<div class="modal fade" data-backdrop="static" id="logOutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="logoutModalLabel">Log out!</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">Do you want to log out?</div>
        <hr />
        <div id="exit_state" class="d-flex justify-content-center" role="alert"></div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
            <a class="btn btn-danger" href="javascript:exitAsync()">Yes</a>
        </div>
        </div>
    </div>
</div>
<!-- User Modal-->
<div class="modal fade" data-backdrop="static" id="changeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Credentials Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table>
                    <tr>
                        <td colspan="2">
                            <input id="id" type="hidden" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="email">E-mail</label>
                        </td>
                        <td class="form-group form-inline">
                            <input id="email" type="email" disabled class="form-control form-control-user" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="password">Password</label>
                        </td>
                        <td class="form-group form-inline">
                            <input id="password" type="password" class="form-control form-control-user" />
                        </td>
                    </tr>
                </table>
                <hr />
                <div id="change_state" class="justify-content-center" role="alert"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-success" href="javascript:validate()">Change</a>
            </div>
        </div>
    </div>
</div>