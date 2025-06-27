<div class="card">
    <div class="card-content">
        <div class="card-header">
            <h3 class="card-title">
                Detail
            </h3>
        </div>
        <div class="card-body row">

            <div class="col-3 col-lg-3 col-md-3 text-center">
                <img src="http://localhost/admin/datasmp/dist/assets/images/avatar/avatar-s-1.png" alt="" class="img-thumbnail col-sm-8">
            </div>
            <div class="col-8 col-lg-8 col-md-8">
                <form class="form form-horizontal" method="POST">
                    <div class="form-body">
                        <div class="row">

                            <div class="col-md-4">
                                <label>NIS / NISN</label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Name" id="first-name-icon" name="nis" value="<?= $data['siswa']['nis'] ?>">
                                        <div class="form-control-icon">
                                            <i data-feather="credit-card"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Name" id="first-name-icon" name="nisn" value="<?= $data['siswa']['nisn'] ?>">
                                        <div class="form-control-icon">
                                            <i data-feather="credit-card"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label>Nama</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Name" id="first-name-icon" name="nama" value="<?= $data['siswa']['nama'] ?>">
                                        <div class="form-control-icon">
                                            <i data-feather="user"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label>JK</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="d-flex">
                                        <div class="col-md-4">
                                            <input type="radio" class="form-check-input" name="jk" value="<?= $data['siswa']['kelamin'] ?>" <?= $data['siswa']['kelamin'] == "L" ? "checked" : "" ?>> Laki=laki
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" class="form-check-input" name="jk" value="<?= $data['siswa']['kelamin'] ?>" <?= $data['siswa']['kelamin'] == "P" ? "checked" : "" ?>> Perempuan
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label>Angkatan</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" class="form-control" id="first-name-icon" name="angkatan" value="<?= $data['siswa']['angkatan'] ?>">
                                        <div class="form-control-icon">
                                            <i data-feather="calendar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label>Jenjang</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Jenjang" id="first-name-icon" name="jenjang" value="<?= jenjang($data['siswa']['id_kelas']) ?>">
                                        <div class="form-control-icon">
                                            <i data-feather="folder"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label>Kelas Sekarang</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Jenjang" id="first-name-icon" name="kelas" value="<?= $data['siswa']['kelas_sekarang'] ?>">
                                        <div class="form-control-icon">
                                            <i data-feather="folder"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end ">
                                <button type="submit" class="btn btn-primary me-1 mb-1 icon icon-left" name="save"> <i data-feather="save"></i> Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>