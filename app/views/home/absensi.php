<div class="card col-lg-12 col-md-12 col-sm-12">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group row align-items-center">
                    <div class="col-lg-4 col-6">
                        <label class="col-form-label">Kelas</label>
                    </div>
                    <div class="col-lg-8 col-6">
                        <?= $data['kelas'] ?>
                    </div>
                </div>
            </div>
        </div>
        <form method="post">
            <div class="row">
                <div class="col-12" id="absensi_siswa">

                </div>
            </div>
            <div class="row d-flex justify-content-end save_absen d-none">
                <div class="col-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary icon icon-left" name="save">
                        <i data-feather="save"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>