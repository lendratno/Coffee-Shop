<div class="d-flex justify-content-center">
    <form class="col-lg-7 mt-3" method="POST" action="<?= base_url('feedback/komentar') ?>">
        <div class="form-group">
            <h4 class="font-weight-bold">Hallo, <?= $this->session->userdata('username'); ?><br>
                <h6>Selamat datang di Feedback Kamu dapat memberikan komentarmu <br>mengenai menu, pelayanan, dan kenyamananmu disini.</h6>
        </div>

        <?php if ($this->session->userdata('role_id') == '2') : ?>

            <div class="form-group row " style="padding-top:30px">
                <label for="nama" class="col-sm-10 col-form-label">Nama :</label><br>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="nama" placeholder="Nama anda.." name="nama">
                </div>
            </div>
            <div class="form-group">
                <label for="komentar">Feedbackmu :</label>
                <textarea class="form-control" id="komentar" name="komentar" rows="3" placeholder="Silahkan berikan feedbackmu disini ya..." <?= set_value('komentar') ?>></textarea>
            </div>

            <div class="form-group" name="komentar">
                <input type="submit" class="form-control btn btn-primary submit px-3" id="kirim" value="komentar">
            </div>

        <?php endif; ?>
    </form>

    <div class="container d-flex justify-content-center mt-100 mb-100">
        <div class="row">
            <div class="col-md-16">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Semua Feedback</h4>
                        <h6 class="card-subtitle">Dari semua pelanggan .NEMU</h6>
                    </div>
                    <?php foreach ($row->result() as $key => $data) { ?>
                        <div class="comment-widgets m-b-20">
                            <div class="d-flex flex-row comment-row">
                                <div class="p-2"><span class="round"><img src="<?= base_url(); ?>assets/img/undraw_profile.svg" alt="user" width="50"></span></div>
                                <div class="comment-text w-100">
                                    <h5 class="mb-1 font-weight-bold"><?= $data->nama ?></h5>
                                    <span class="date font-weight-normal" style="font-size: 12px;"><?= $data->time ?></span>
                                    <p class="m-b-5 m-t-10"><?= $data->komentar ?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>