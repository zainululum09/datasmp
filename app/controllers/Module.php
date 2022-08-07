<?php

class Module extends Controller
{
    public function read_excel()
    {
        if ($_FILES) {
            $this->model('Base_model')->read_excel($_FILES);
        }
    }

    public function getdatasiswa()
    {
        echo json_encode($this->model('Base_model')->datasiswa());
    }

    public function count()
    {
        $this->model('Base_model')->count();
    }

    public function cari_siswa()
    {
        $output = '<div class="list-group">';
        $data = $this->model('Base_model')->cari_siswa($_POST['name']);
        if ($data) {
            foreach ($data as $row) :
                $output .= '<a class="list-group-item list-group-item-action" href="' . BASEURL . 'home/detsiswa/' . $row['nis'] . '">' . $row['nama'] . ' - ' . $row['kelas_sekarang'] . '</a>';
            endforeach;
        } else {
            $output .= '<a class="list-group-item disabled bg-warning text-dark" href="#">Data tidak ditemukan</a>';
        }

        $output .= '</div>';
        echo $output;
    }

    public function getsiswakelas()
    {
        $output = '<table class="table table-striped table-sm table-bordered">
                    <thead  class="text-center bg-secondary text-white">
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>NISN</th>
                            <th>Nama Peserta Didik</th>
                            <th>Kehadiran</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead><tbody>';
        $i = 1;
        foreach ($this->model('Base_model')->getsiswakelas() as $row) :
            $output .= '<tr>
            
            <input type="hidden" value="' . $row['nis'] . '" name="nis[' . $i . ']">
                    <td class="text-end">' . $i . '</td>
                    <td class="text-center">' . $row['nis'] . '</td>
                    <td class="text-center">' . $row['nisn'] . '</td>
                    <td>' . $row['nama'] . '</td>
                    <td class="d-flex justify-content-around p-4">
                        <div class="form-check form-check-success">
                            <input class="form-check-input" type="radio" name="kehadiran[' . $i . ']" id="kehadiran[' . $i . ']" value="H" checked>
                            <label class="form-check-label" for="Success">
                                H
                            </label>
                        </div>
                        <div class="form-check form-check-primary">
                            <input class="form-check-input" type="radio" name="kehadiran[' . $i . ']" id="kehadiran[' . $i . ']" value="S">
                            <label class="form-check-label" for="Primary">
                                S
                            </label>
                        </div>
                        <div class="form-check form-check-warning">
                            <input class="form-check-input" type="radio" name="kehadiran[' . $i . ']" id="kehadiran[' . $i . ']" value="I">
                            <label class="form-check-label" for="Warning">
                                I
                            </label>
                        </div>
                        <div class="form-check form-check-danger">
                            <input class="form-check-input" type="radio" name="kehadiran[' . $i . ']" id="kehadiran[' . $i . ']" value="A">
                            <label class="form-check-label" for="Danger">
                                A
                            </label>
                        </div>
                    </td>
                    <td>
                        <textarea name="ket[' . $i . ']" class="form-control"></textarea>
                    </td>
                </tr>';
            $i++;
        endforeach;

        $output .= '</tbody></table>';
        echo $output;
    }
}
