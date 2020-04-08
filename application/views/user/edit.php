<div class="card-deck mb-3">
    <div class="card mb-4 shadow-sm">
        <div class="card-header">
            <h4 class="my-0 font-weight-normal">Edit Profile</h4>
        </div>
        <div class="card-body">
            <?= $this->session->flashdata('message'); ?>
            <?= $this->session->flashdata('error_msg'); ?>

            <?= form_open_multipart('user/edit') ?>
            <div class="form-group row">
                <div class="col-sm-3">
                    <img width="200" src="<?= base_url('assets/img/profile/') . $user['image'] ?>" />
                </div>
                <div class="col-sm-9">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="inputEmail3" value="<?= $user['email']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="name" name="name" class="form-control" id="inputName" value="<?= $user['name']; ?>">
                            <?= form_error('name', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword3">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                        <div class="input-group col-sm-10">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" name="image" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>
                        <?= form_error('image', '<small class="form-text text-danger">', '</small>'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group row text-right">
                <div class="col-sm-12">
                    <hr />
                    <a href="<?= base_url('user/password') ?>" type="submit" class="btn btn-danger">Change Password</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<script type="application/javascript">
    $('.custom-file-input').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>