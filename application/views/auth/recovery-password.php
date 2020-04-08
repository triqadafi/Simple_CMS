<div class="container">
    <br>
    <p class="text-center">More bootstrap 4 components on <a href="http://bootstrap-ecommerce.com/"> Bootstrap-ecommerce.com</a></p>
    <hr>


    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <header class="card-header">
                    <h4 class="card-title mt-2">Account Recovery</h4>
                    <h5 class="card-title mt-2"><?= $this->session->userdata('reset_email'); ?></h5>
                </header>
                <article class="card-body">
                    <form method="POST" action="<?= base_url('auth/recoveryAction'); ?>">
                        <div class="form-row">
                            <div class="col form-group">
                                <label>New password</label>
                                <input type="password" name="password1" class="form-control" placeholder="">
                                <?= form_error('password1', '<small class="form-text text-danger">', '</small>'); ?>
                            </div> <!-- form-group end.// -->
                            <div class="col form-group">
                                <label>Repeat password</label>
                                <input type="password" name="password2" class="form-control" placeholder="">
                                <?= form_error('password2', '<small class="form-text text-danger">', '</small>'); ?>
                            </div> <!-- form-group end.// -->
                        </div> <!-- form-row end.// -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                        </div> <!-- form-group// -->
                    </form>
                </article> <!-- card-body end .// -->
            </div> <!-- card.// -->
        </div> <!-- col.//-->

    </div> <!-- row.//-->


</div>