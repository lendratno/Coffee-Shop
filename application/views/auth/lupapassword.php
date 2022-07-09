<body class="img js-fullheight" style="background-image: url(<?= base_url('/assets/images/bg.jpg'); ?>);">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-md-6 text-center mb-4">
                    <img src=<?= base_url("assets/img/nemu-logo.png") ?> alt="logo" style="width: 190px; height: 100px; margin-bottom: -30px;">
                </div>
            </div>

            <div class="form-text text-center mb-2 mt-3 text-white h4">Lupa Password
            </div>


            <?= $this->session->flashdata('message'); ?>

            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">

                        <form method="POST" action="<?= base_url('auth/lupapassword'); ?>" class="signin-form">
                            <div class="form-group">
                                <input type="text" id="email" name="email" class="form-control" placeholder="Masukkan email..." required value="<?= set_value('email'); ?>">
                                <?= form_error('email'); ?>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3 font-weight-bold">Reset Password</button>
                            </div>

                            <div class="form-group d-md-flex">
                                <div class="w-50">
                                    <a href="<?= base_url('auth'); ?>" style="color: #fff">Kembali Login</a>
                                    </label>
                                </div>
                        </form>

                    </div>
                </div>

            </div>

        </div>

    </section>