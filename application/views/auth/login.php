<body class="img js-fullheight" style="background-image: url(<?= base_url('/assets/images/bg.jpg'); ?>);">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-md-6 text-center mb-5">
                    <img src="assets/img/nemu-logo.png" alt="logo" style="width: 190px; height: 100px; margin-bottom: -30px;">
                </div>
            </div>

            <?= $this->session->flashdata('message'); ?>

            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">

                        <form method="POST" action="<?= base_url('auth'); ?>" class="signin-form">
                            <div class="form-group">
                                <input type="text" id="username" name="username" class="form-control" placeholder="Username.." required value="<?= set_value('username'); ?>">
                                <?= form_error('username'); ?>
                            </div>
                            <div class="form-group">
                                <input id="password" name="password" type="password" class="form-control" placeholder="Password" required>
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                <?= form_error('password'); ?>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3 font-weight-bold">Masuk</button>
                            </div>

                            <div class="form-group d-md-flex">
                                <div class="w-50">
                                    <a href="<?= base_url('/auth/registrasi'); ?>" style="color: #fff">Belum Punya Akun?</a>
                                    </label>
                                </div>

                                <div class="form-group d-md-flex">
                                    <div class="w-40 ml-5">
                                        <a href="<?= base_url('/auth/lupapassword'); ?>" style="color: #fff">Lupa Password?</a>
                                        </label>
                                    </div>


                                </div>
                        </form>

                    </div>
                </div>

            </div>

        </div>

    </section>