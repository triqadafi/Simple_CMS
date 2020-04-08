<div class="container">
    <br>
    <p class="text-center">More bootstrap 4 components on <a href="http://bootstrap-ecommerce.com/"> Bootstrap-ecommerce.com</a></p>
    <hr>


    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <header class="card-header">
                    <h4 class="card-title mt-2">Sign up</h4>
                </header>
                <article class="card-body">
                    <form method="POST" action="<?= base_url('auth/registration'); ?>">
                        <div class="form-row">
                            <div class="col form-group">
                                <label>First name </label>
                                <input type="text" name="name" class="form-control" placeholder="" value="<?= set_value('name'); ?>">
                                <?= form_error('name', '<small class="form-text text-danger">', '</small>'); ?>
                            </div> <!-- form-group end.// -->
                            <div class="col form-group">
                                <label>Last name</label>
                                <input type="text" name="lastname" class="form-control" placeholder=" ">
                            </div> <!-- form-group end.// -->
                        </div> <!-- form-row end.// -->
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" name="email" class="form-control" placeholder="" value="<?= set_value('email'); ?>">
                            <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                            <?= form_error('email', '<small class="form-text text-danger">', '</small>'); ?>
                        </div> <!-- form-group end.// -->
                        <div class="form-row">
                            <div class="col form-group">
                                <label>Create password</label>
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
                            <button type="submit" class="btn btn-primary btn-block"> Register </button>
                        </div> <!-- form-group// -->
                        <small class="text-muted">By clicking the 'Sign Up' button, you confirm that you accept our <br> Terms of use and Privacy Policy.</small>
                    </form>
                </article> <!-- card-body end .// -->
                <div class="border-top card-body text-center">Have an account? <a href="<?= base_url('auth'); ?>">Log In</a></div>
            </div> <!-- card.// -->
        </div> <!-- col.//-->

    </div> <!-- row.//-->


</div>