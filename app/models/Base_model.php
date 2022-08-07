<?php
class Base_model
{
    public function __construct()
    {
        $this->db = new Database;
    }

    public function cek_login()
    {
        $sql = "SELECT * FROM `admin_user` WHERE `username`=:username";
        $this->db->query($sql);
        $this->db->bind('username', $_POST['username']);
        $user = $this->db->single();
        if ($user > 0) {
            if (password_verify($_POST['password'], $user['password'])) {
                $_SESSION = [
                    'role' => $user['role'],
                    'userid' => $user['id']
                ];
                header("location:" . BASEURL);
                exit;
            } else {
                $_SESSION['signer'] = "<span class='text-danger'> Password Salah </span>";
                header("location:" . BASEURL);
                exit;
            }
        } else {
            $_SESSION['signer'] = "<span class='text-danger'> Username tidak ditemukan </span>";
            header("location:" . BASEURL);
            exit;
        }
    }

    public function menu($role)
    {
        $sql = "SELECT * FROM `menu` WHERE `cat`=:cat";
        $this->db->query($sql);
        $this->db->bind('cat', 1);
        $men = $this->db->resultset();
        $menu = '';
        foreach ($men as $m) :
            $menu .= '<li class="sidebar-item" data-url="' . $m['menu'] . '">
                        <a href="' . BASEURL . $m['controller'] . '"  class="sidebar-link">
                            <i data-feather="' . $m['icon'] . '" width="20"></i>
                            <span>' . $m['menu'] . '</span>
                        </a>
                      </li>';
        endforeach;

        if ($role == 'su') {
            return $menu . $this->menu2();
        } else {
            return $menu;
        }
    }

    protected function menu2()
    {
        $sql = "SELECT * FROM `menu` WHERE `cat`=:cat";
        $this->db->query($sql);
        $this->db->bind('cat', 2);
        $men = $this->db->resultset();
        $menu2 = '';
        $menu2 .= "<li class='sidebar-title'>Administrator</li>";
        foreach ($men as $m) :
            $menu2 .= '<li class="sidebar-item" data-url="' . $m['menu'] . '">
                        <a href="' . BASEURL . $m['controller'] . '"  class="sidebar-link">
                            <i data-feather="' . $m['icon'] . '" width="20"></i>
                            <span>' . $m['menu'] . '</span>
                        </a>
                      </li>';
        endforeach;
        return $menu2;
    }

    public function import_excel()
    {
        $inputFileName = $_FILES['excel_file']['name'];
        if ($inputFileName != '') {
            $allow_ext = array('xls', 'xlsx', 'csv');
            $file_array = explode('.', $inputFileName);
            $fileExt = end($file_array);

            if (in_array($fileExt, $allow_ext)) {
                $fileName = time() . '.' . $fileExt;
                move_uploaded_file($_FILES['excel_file']['tmp_name'], 'tmp/' . $fileName);
                $fileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify('tmp/' . $fileName);
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($fileType);
                $spreadsheet = $reader->load('tmp/' . $fileName);
                unlink('tmp/' . $fileName);
                $excelData = [
                    'excelHRow' => $spreadsheet->getActiveSheet()->getHighestRow(),
                    'excelData' => $spreadsheet->getActiveSheet()->toArray()
                ];
                return $excelData;
            }
        }
    }

    public function read_excel()
    {
        echo json_encode($this->import_excel()['excelData']);
    }

    public function insert_siswa()
    {
        $data = count($_POST['nis']);
        if ($data > 1) {
            for ($i = 0; $i < $data; $i++) :
                $this->detsiswa($_POST['nis'][$i]);
                $result = $this->db->single();

                if ($result < 1) {
                    $sql = 'INSERT INTO `siswa` (`nis`, `nisn`, `nama`, `kelamin`, `id_kelas`,`kelas_sekarang`, `angkatan`, `tglupload`, `spp`) VALUES ("' . htmlspecialchars($_POST['nis'][$i]) . '","' . htmlspecialchars($_POST['nisn'][$i]) . '","' . htmlspecialchars($_POST['nama_siswa'][$i]) . '","' . htmlspecialchars($_POST['jk'][$i]) . '","' . htmlspecialchars($_POST['jenjang'][$i]) . '","' . '","' . htmlspecialchars($_POST['kelas']) . '","' . htmlspecialchars($_POST['angkatan'][$i]) . '","' . htmlspecialchars(time()) . '","50000")';
                    // $this->db->execute();

                    $ta_n = substr(($_POST['angkatan'][$i]), 2, 2) + 1;
                    $ta = 'TH' . substr(($_POST['angkatan'][$i]), 2, 2) . $ta_n;
                    $sql_kelas = 'INSERT INTO `kelas_siswa` (`nis`,`tahun_ajar`,`nama_kelas`,`tgl_upload`) VALUES ("' . htmlspecialchars($_POST['nis'][$i]) . '","' . $ta . '","' . htmlspecialchars($_POST['kelas'][$i]) . '","' . date("Y-m-d", time()) . '")';

                    $this->db->query($sql);
                    $this->db->execute();
                    $this->db->query($sql_kelas);
                    $this->db->execute();
                } elseif ($result['nis'] > 0 && $result != $_POST['kelas'][$i]) {
                    $sql1 = "UPDATE `siswa` SET `kelas_sekarang`=:kelas WHERE `nis`=:nis";
                    $this->db->query($sql1);
                    $this->db->bind('kelas', htmlspecialchars($_POST['kelas'][$i]));
                    $this->db->bind('nis', htmlspecialchars($_POST['nis'][$i]));
                    $this->db->execute();

                    $sql2 = "UPDATE `kelas_siswa` SET `nama_kelas`=:kelas WHERE `nis`=:nis";
                    $this->db->query($sql2);
                    $this->db->bind('kelas', htmlspecialchars($_POST['kelas'][$i]));
                    $this->db->bind('nis', htmlspecialchars($_POST['kelas'][$i]));
                    $this->db->execute();
                } else {
                    echo 'Data Sudah ada';
                }

            endfor;
            redirect("home/datasiswa");
        }
    }

    function count()
    {
        $sql_count = "SELECT count(*) as jumlah FROM siswa";
        $this->db->query($sql_count);
        // $this->db->execute();
        $row = $this->db->single();
        var_dump($row);
    }

    public function datasiswa()
    {
        $page = (isset($_POST['page'])) ? $_POST['page'] : 1;
        $limit = 20;
        $limit_start = ($page - 1) * $limit;
        $no = $limit_start + 1;
        $output = '<table class="table table-striped table-bordered table-sm table-hover" id="data_siswa">
                    <thead class="text-center bg-secondary text-white">
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>NISN</th>
                            <th>Nama Peserta Didik</th>
                            <th>JK</th>
                            <th>Jenjang</th>
                            <th>Kelas</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';

        $sql_ta = "SELECT * FROM tahun_ajaran ORDER BY kode_ta DESC LIMIT 1";
        $this->db->query($sql_ta);
        $ta = $this->db->single();
        $query = "SELECT * FROM siswa JOIN kelas_siswa ON kelas_siswa.nis=siswa.nis WHERE kelas_siswa.tahun_ajar='" . $ta['kode_ta'] . "'  ORDER BY nama ASC LIMIT $limit_start, $limit";
        $this->db->query($query);
        foreach ($this->db->resultset() as $row) :
            $output .= '<tr>
                    <td class="text-end px-2"> ' . $no++ . '</td>
                    <td class="text-center"> ' . $row['nis'] . '</td>
                    <td class="text-center"> ' . $row['nisn'] . '</td>
                    <td class="px-2"> ' . $row['nama'] . '</td>
                    <td class="text-center"> ' . $row['kelamin'] . '</td>
                    <td class="text-center"> ' . jenjang($row['id_kelas']) . '</td>
                    <td class="text-center"> ' . $row['kelas_sekarang'] . '</td>
                    <td class="d-flex justify-content-around">
                    <a href="' . BASEURL . 'home/detsiswa/' . $row['nis'] . '" class="btn btn-info py-1 px-2"> Cek </a>
                    <a href="' . BASEURL . 'module/del_siswa/' . $row['nis'] . '" class="btn btn-danger py-1 px-2"> <i data-feather="trash"> </i> Hapus </a>
                    </td>
                  </tr>';
        endforeach;

        $sql_count = "SELECT count(*) as jumlah FROM siswa JOIN kelas_siswa ON kelas_siswa.nis=siswa.nis WHERE kelas_siswa.tahun_ajar='" . $ta['kode_ta'] . "'";
        $this->db->query($sql_count);
        $res = $this->db->single();
        $total = $res['jumlah'];

        $output .= '</tbody></table>
        <div class="row">
            <div class="col-2">
            <span class="h5">Jumlah Siswa : ' . $total . '</span>
            </div>
            <div class="col-4">
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-primary" id="page">';


        $jumlah_page = ceil($total / $limit);
        $jumlah_number = 1; //jumlah halaman ke kanan dan kiri dari halaman yang aktif
        $start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1;
        $end_number = ($page < ($jumlah_page - $jumlah_number)) ? $page + $jumlah_number : $jumlah_page;

        if ($page == 1) {
            $output .= '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
            $output .= '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
        } else {
            $link_prev = ($page > 1) ? $page - 1 : 1;
            $output .= '<li class="page-item halaman" id="1"><a class="page-link" href="#">First</a></li>';
            $output .= '<li class="page-item halaman" id="' . $link_prev . '"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
        }

        for ($i = $start_number; $i <= $end_number; $i++) {
            $link_active = ($page == $i) ? 'active' : '';
            $output .= '<li class="page-item halaman ' . $link_active . '" id="' . $i . '"><a class="page-link" href="#">' . $i . '</a></li>';
        }

        if ($page == $jumlah_page) {
            $output .= '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
            $output .= '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
        } else {
            $link_next = ($page < $jumlah_page) ? $page + 1 : $jumlah_page;
            $output .= '<li class="page-item halaman" id="' . $link_next . '"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
            $output .= '<li class="page-item halaman" id="' . $jumlah_page . '"><a class="page-link" href="#">Last</a></li>';
        }

        $output .= "</ul></nav> </div></div>";

        return $output;
    }

    public function detsiswa($nis)
    {
        $sql = "SELECT * FROM `siswa` WHERE `nis`=:nis";
        $this->db->query($sql);
        $this->db->bind('nis', $nis);
        return $this->db->single();
    }

    public function cari_siswa($nama)
    {
        $sql = "SELECT * FROM `siswa` WHERE `nama` LIKE '%$nama%' OR `nis` LIKE '%$nama%'";
        $this->db->query($sql);
        return $this->db->resultset();
    }

    public function get_kelas()
    {
        $sql = "SELECT * FROM tahun_ajaran ORDER BY kode_ta DESC LIMIT 1";
        $this->db->query($sql);
        $ta = $this->db->single();

        $sql_kelas = "SELECT * FROM kelas_siswa GROUP BY nama_kelas ORDER BY nama_kelas ASC";
        // $sql_kelas = "SELECT * FROM kelas_siswa WHERE tahun_ajar='" . $ta['kode_ta'] . "' GROUP BY nama_kelas ORDER BY nama_kelas ASC";
        $this->db->query($sql_kelas);
        $output = '<select class="form-select absen_kelas" id="basicSelect"><option>.:: Pilih Kelas ::.</option>';
        foreach ($this->db->resultset() as $row) :
            $output .= '<option value="' . $row['nama_kelas'] . '">' . $row['nama_kelas'] . '</option>';
        endforeach;
        $output .= '</select>';
        return $output;
    }

    public function getsiswakelas()
    {
        $sql = "SELECT * FROM `siswa` WHERE `kelas_sekarang` = '" . $_POST['kelas'] . "'";
        $this->db->query($sql);
        return $this->db->resultset();
    }

    public function saveAbsen()
    {
        for ($i = 0; $i <= count($_POST['nis']); $i++) :
            if ($_POST['kehadiran'][$i] != "H" && $_POST['nis'][$i] != null) {
                if (date('mm', time()) > 7) {
                    $smt = 1;
                } else {
                    $smt = 2;
                }
                $query = "INSERT INTO `absensi` (`time`, `nis`,`kelas`, `absen`,`semester`,`ket`) VALUES ('" . time() . "','" . $_POST['nis'][$i] . "','" . $_POST['kelas'] . "','" . $_POST['kehadiran'][$i] . "','" . $smt . "','" . $_POST['ket'][$i] . "')";
                var_dump($query);
                // die;
                $this->db->query($query);
                $this->db->execute();
            }
        endfor;
        redirect();
    }
}
