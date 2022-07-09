<div id="menu" class="menu mb-4" style="background-image: url('<?= base_url('/assets/images/bg-menu.jpg') ?>');">
	<div class="container mb-4">

		<?php if ($this->session->userdata('role_id') == '1') : ?>
			<a href="<?= base_url('tambah_menu'); ?>" class="btn btn-primary mt-3">Tambah Menu</a><br><br>
		<?php endif;  ?>

		<h4 class="font-weight-bold mt-1" style="padding-top: 15px;">Kategori :</h4>


		<div class="btn-group mb-3" role="group" aria-label="Basic example" id="kategori">

			<a method="post" href="<?= base_url('SemuaMenu/') ?>">
				<button type="submit" class="btn btn-outline-warning font-weight-bold">Semua Menu</button>
			</a>

			<a method="post" href="<?= base_url('kopiasli/') ?>">
				<button type="submit" class="btn btn-outline-dark font-weight-bold ml-1">Coffee</button>
			</a>
			<a method="post" href="<?= base_url('nonkopi/') ?>">
				<button type="submit" class="btn btn-outline-secondary font-weight-bold ml-1">Non Coffee</button>
			</a>
			<a method="post" href="<?= base_url('makanan/') ?>">
				<button type="submit" class="btn btn-outline-info font-weight-bold ml-1">Makanan</button>
			</a>
		</div>


		<div class="row mt-3">
			<?php foreach ($menu as $m) : ?>
				<div class="col-lg-3">

					<div class="shadow p-3 mb-5 bg-white">
						<img src="<?= base_url('assets/img/menu/') . $m['image']; ?>" class="img-fluid">
						<div class="text-center mt-2">
							<h5><?= $m['kopi']; ?></h5>
							<p class="mb-1">IDR <?= number_format($m['harga'], 2, ',', '.'); ?></p>

							<!-- Button to Open the Modal -->
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
								Info
							</button>

							<!-- The Modal -->
							<?php foreach ($menu as $k) : ?>
								<!-- Tambah Disini -->
								<div class="modal" id="myModal">
									<div class="modal-dialog">
										<div class="modal-content">

											<!-- Modal Header -->
											<div class="modal-header">
												<h4 class="modal-title">
													<h5><?= $k['kopi']; ?></h5> <!-- Tambah Disini -->
												</h4>
												<button type="button" class="close" data-dismiss="modal">&times;</button>
											</div>

											<!-- Modal body -->
											<div class="modal-body">
												<h7><?= $k['deskrpsi']; ?></h7> <!-- Tambah Disini -->
											</div>

											<!-- Modal footer -->
											<div class="modal-footer">
												<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
											</div>

										</div>
									</div>
								</div>
							<?php endforeach; ?>
							<!-- Tambah Disini -->

							<?php if ($this->session->userdata('role_id') == '2') : ?>
								<a href="<?= base_url('menu/pesan/') . $m['id']; ?>" class="btn btn-pesan">Pesan</a>
							<?php endif;  ?>


							<?php if ($this->session->userdata('role_id') == '1') : ?>
								<a href="<?= base_url('menu/hapusmenu/') . $m['id']; ?>" class="btn btn-pesan">Hapus</a>
							<?php endif;  ?>

						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="row justify-content-center mt-2">
			<?= $this->pagination->create_links(); ?>
		</div>
	</div>
</div>