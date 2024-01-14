<div class="card">
    <div class="card-header p-3">
        <h3 class="card-title">Beri Perhitungan Baru</h3>

    </div>
    <div class="card-body">
        <div class="hal-1">
            <div class="form-group">
                <label for="karyawan">Karyawan</label>
                <select name="karyawan" id="karyawan" class="form-control">
                    <?php foreach ($karyawan as $k) : ?>
                        <option value="<?= $k->id ?>"> <?= $k->nama . ' - ' .  $k->nip ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="row mt-2">
                <div class="col-sm-12 col-md-6">
                    <h4 class="col-12 mb-3">Pilih Kriteria Yang Akan Digunakan</h4>
                    <?php foreach ($kriteria as $v) : ?>
                        <div class="custom-control custom-checkbox mb-4">
                            <input data-text="<?= $v->nama_kriteria ?>" name="kriteria" value="<?= $v->id ?>" type="checkbox" class="custom-control-input" id="kriteria-<?= $v->id ?>">
                            <label class="custom-control-label" for="kriteria-<?= $v->id ?>"><?= $v->nama_kriteria ?></label>
                        </div>
                    <?php endforeach ?>
                </div>
                <div class="col-sm-12 col-md-6">
                    <h4 class="col-12 mb-3">Pilih Sub Kriteria Yang Akan Digunakan</h4>
                    <?php foreach ($subkriteria as $v) : ?>
                        <div class="custom-control custom-checkbox mb-4">
                            <input name="subkriteria" data-text="<?= $v->nama_subkriteria ?>" value="<?= $v->id ?>" type="checkbox" class="custom-control-input" id="subkriteria-<?= $v->id ?>">
                            <label class="custom-control-label" for="subkriteria-<?= $v->id ?>"><?= $v->nama_subkriteria ?></label>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <div style="text-align:center" class="mt-4">
                <button class="btn btn-primary" id="next">Lanjut</button>
            </div>
        </div>

        <div style="display: none;" class="hal-2">
            <div class="row">
                <div class="col-sm-12 col-md-6" id="bobot-kriteria">
                    <h4 class="col-12 mb-3">Isi Bobot Kriteria</h4>

                </div>
                <div class="col-sm-12 col-md-6" id="bobot-subkriteria">
                    <h4 class="col-12 mb-3">Isi Bobot Sub Kriteria</h4>

                </div>
            </div>
            <div class="row" id="hasil-proses">

            </div>
            <div class="mt-4 row justify-content-center" style="column-gap: 5px;">
                <button class="btn btn-secondary" id="back">Kembali</button>
                <button class="btn btn-primary" id="proses">Proses</button>
            </div>
        </div>
    </div>
</div>