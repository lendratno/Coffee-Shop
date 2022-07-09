<!-- Riwayat -->
<div id="pesanan" class="pesanan">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-9 pr-5">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Riwayat</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead align="center">
                                    <tr>
                                        <th>Nama</th>
                                        <th>No. Pesanan</th>
                                        <th>Menu</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($join_user_menu as $row) { ?>
                                        <tr>
                                            <td><?= $row->username ?></td>
                                            <td align="center"><?= $row->no_pesanan ?></td>
                                            <td><?= $row->kopi ?></td>
                                            <td align="center"><?= $row->quantity ?></td>
                                            <td><?= $row->subtotal ?></td>
                                        </tr>
                                    <?php } ?>

                                </tbody>


                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End -->