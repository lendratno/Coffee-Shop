<body class="img js-fullheight" style="background-image: url(<?= base_url('/assets/images/bg-regis.jpg'); ?>);">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Halaman Registrasi</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">

                        <form class="signin-form" method="POST" action="<?= base_url('auth/registrasi'); ?>">
                            <div class="form-group">
                                <input type="text" id="email" name="email" class="form-control" placeholder="Email" value="<?= set_value('email'); ?>">
                                <?= form_error('email'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" id="username" name="username" minlength="5" class="form-control" placeholder="Username" value="<?= set_value('username'); ?>">
                                <?= form_error('username'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" id="name" name="name" class="form-control" placeholder="Nama Lengkap" value="<?= set_value('name'); ?>">

                            </div>
                            <div class="form-group">
                                <input id="password1" name="password1" type="password" class="form-control" placeholder="Password" required>
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                <?= form_error('password1'); ?>
                            </div>
                            <div class="form-group">
                                <input id="password2" name="password2" type="password" class="form-control" placeholder="Ulang Password" required>
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                <?= form_error('password2'); ?>
                            </div>

                    </div>
                    <div class="form-group">
                        <button type="submit" class="form-control btn btn-primary submit px-3">Daftar</button>
                    </div>
                    <div class="w-50 text-md-mid">
                        <a href="<?= base_url('auth') ?>" style="color: #fff">Sudah Punya Akun?</a>
                    </div>
                    </form>

                </div>
            </div>
        </div>
        </div>
    </section>