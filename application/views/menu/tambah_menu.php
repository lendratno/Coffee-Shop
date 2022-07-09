<div class="container">
    <?php echo form_open_multipart('tambah_menu/simpanmenubaru'); ?>


    <div class="form-group row " style="padding-top:30px">
        <label for="kopi" class="col-sm-2 col-form-label">Nama Menu</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="kopi" name="kopi">
        </div>
    </div>
    <div class="form-group row">
        <label for="harga" class="col-sm-2 col-form-label">Harga</label>
        <div class=" col-sm-5">
            <input type="harga" class="form-control" id="harga" name="harga">
        </div>
    </div>

    <div class="form-group row">
        <label for="deskrpsi" class="col-sm-2 col-form-label">Deskripsi</label>
        <div class=" col-sm-5">
            <input type="deskrpsi" class="form-control" id="deskrpsi" name="deskrpsi">
        </div>
    </div>

    <div class="form-group row">
        <label for="rekomendasi" class="col-sm-2 col-form-label">Rekomendasi </label>
        <div class="form-group">
            <select id="rekomendasi" class="form-control" name="rekomendasi">
                <option>- Pilih </option>
                <option>Rekomendasi</option>
                <option>Tidak Rekomendasi</option>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="category" class="col-sm-2 col-form-label">Kategori </label>
        <div class="form-group">
            <select id="kategori" class="form-control" name="category">
                <option>- Pilih Kategori</option>
                <option>Coffee</option>
                <option>Non Coffee</option>
                <option>Makanan</option>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="deskrpsi" class="col-sm-2 col-form-label">Upload Foto :</label>
        <div class=" col-sm-5">
            <div class="input-group mb-3 ">
                <div class="custom-file">
                    <input type="file" name="image" class="custom-file-input" id="image">
                    <label class="custom-file-label" for="image">Choose file</label>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Tambah Menu</button>
                </div>
            </div>
            <?php form_close(); ?>
        </div>