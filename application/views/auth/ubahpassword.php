<body class="img js-fullheight" style="background-image: url(<?= base_url('/assets/images/bg.jpg'); ?>);">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-md-6 text-center mb-5">
                    <img src=<?= base_url("assets/img/nemu-logo.png") ?> alt="logo" style="width: 190px; height: 100px; margin-bottom: -30px;">
                </div>
            </div>

            <div class="form-text text-center mb-2 mt-3 text-white h4">Ubah Password
                <?= $this->session->userdata('reset_mail'); ?>
            </div>

            <?= $this->session->flashdata('message'); ?>

            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">

                        <form method="POST" action="<?= base_url('auth/ubahpassword'); ?>" class="signin-form">
                            <div class="form-group">
                                <input type="password" id="password1" name="password1" class="form-control" placeholder="Masukkan password baru..." required>
                                <?= form_error('password1'); ?>
                            </div>
                            <div class="form-group">
                                <input type="password" id="password2" name="password2" class="form-control" placeholder="Ulang password..." required>
                                <?= form_error('password2'); ?>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3 font-weight-bold">Ubah Password</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>

        </div>

    </section>