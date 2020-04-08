<div class="card-deck mb-3">
    <div class="card mb-4 shadow-sm">
        <div class="card-header">
            <h4 class="my-0 font-weight-normal">Change Password</h4>
        </div>
        <div class="card-body">
            <?= $this->session->flashdata('message'); ?>
            <?= form_open('user/password') ?>
            <div class="form-group row">
                <label for="inputPassword0" class="col-sm-3 col-form-label">Current Password</label>
                <div class="col-sm-4">
                    <input type="password" name="password_current" class="form-control" id="inputPassword0">
                    <?= form_error('password_current', '<small class="form-text text-danger">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword1" class="col-sm-3 col-form-label">New Password</label>
                <div class="col-sm-4">
                    <input type="password" name="password_new" class="form-control" id="inputPassword1">
                    <?= form_error('password_new', '<small class="form-text text-danger">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword2" class="col-sm-3 col-form-label">Confirm Password</label>
                <div class="col-sm-4">
                    <input type="password" name="password_confirm" class="form-control" id="inputPassword2">
                    <?= form_error('password_confirm', '<small class="form-text text-danger">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row text-right">
                <div class="col-sm-12">
                    <hr />
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>