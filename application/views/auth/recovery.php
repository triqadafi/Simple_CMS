<div class="container">
    <br>
    <p class="text-center">More bootstrap 4 components on <a href="http://bootstrap-ecommerce.com/"> Bootstrap-ecommerce.com</a></p>
    <hr>


    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <header class="card-header">
                    <h4 class="card-title mt-2">Forgor yout password?</h4>
                </header>
                <article class="card-body">
                    <?= $this->session->flashdata('message'); ?>
                    <form method="POST" action="<?= base_url('auth/recovery'); ?>">
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" name="email" class="form-control" placeholder="" value="<?= set_value('email'); ?>">
                            <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                            <?= form_error('email', '<small class="form-text text-danger">', '</small>'); ?>
                        </div> <!-- form-group end.// -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                        </div> <!-- form-group// -->
                    </form>
                </article> <!-- card-body end .// -->
                <div class="border-top card-body text-center"><a href="<?= base_url('auth'); ?>">Back to login</a></div>
            </div> <!-- card.// -->
        </div> <!-- col.//-->

    </div> <!-- row.//-->


</div>