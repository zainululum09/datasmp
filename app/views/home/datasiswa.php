<div class="card col-lg-12 col-md-12 col-sm-12">
    <div class="card-body">
        <div class="row d-flex justify-content-between">
            <div class="col-md-6">

            </div>
            <div class="col-lg-3 col-md-3 d-flex justify-content-between">
                <button class="btn btn-primary icon icon-left add_siswa" data-toggle="modal" data-target="#data_modal"><i data-feather="user-plus"></i> Tambah Siswa</button>
                <button class="btn btn-success icon icon-left import" data-toggle="modal" data-target="#data_modal"><i data-feather="database"></i> Import Excel</button>
            </div>
        </div>
        <hr class="divider">
        <div class="row mt-4">
            <div class="col-lg-12 col-md-12 col-sm-12 table-responsive-sm" id="datasiswa">

            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="data_modal" tabindex="-1" aria-labelledby="data_modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="data_modalLabel">Modal title </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <section id="import" class="d-none">
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="row d-flex justify-content-between">
                            <div class="form-file col-sm-6" id="import_excel">
                                <input type="file" class="form-file-input" id="excel_file" name="excel_file">
                                <label class="form-file-label" for="customFile">
                                    <span class="form-file-text">Upload Excel</span>
                                </label>
                            </div>
                            <div class="col-sm-4 d-flex justify-content-end">
                                <a href="<?= BASEURL ?>public/attribute/Sample_Import.xlsx" class="btn btn-info icon icon-left"> <i data-feather="download"></i> Download Format</a>
                            </div>
                        </div>
                        <table class=" mt-2 table table-striped table-bordered data_siswa">
                            <thead class="text-center bg-secondary text-white">

                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer py-1">
                        <button type="button" class="btn btn-light-secondary icon icon-left" data-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i> Close
                        </button>
                        <button class="btn btn-primary icon icon-left" type="submit" name="import_siswa"> <i data-feather="save"></i> Save</button>
                    </div>
                </form>
            </section>

            <section id="add_siswa" class="d-none">
                <form action="" method="post">
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary icon icon-left" data-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i> Close
                        </button>
                        <button class="btn btn-primary icon icon-left" type="submit" name="import_siswa"> <i data-feather="save"></i> Save</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>