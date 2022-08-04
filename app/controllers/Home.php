<?php

class Home extends Controller
{
    public function index()
    {
        if ($_SESSION['userid']) {
            $data = [
                'menu' => $this->model('Base_model')->menu($_SESSION['role']),
                'title' => "Dashboard"
            ];

            $this->view('layout/head', $data);
            $this->view('home/dashboard', $data);
            $this->view('layout/foot');
        } else {
            $this->login();
        }
    }

    public function datasiswa()
    {
        if ($_SESSION['userid']) {
            $data = [
                'menu' => $this->model('Base_model')->menu($_SESSION['role']),
                'title' => "Data Siswa"
            ];

            if (isset($_POST['import_siswa'])) {
                $this->model('Base_model')->insert_siswa();
            } else {
                $this->view('layout/head', $data);
                $this->view('home/datasiswa', $data);
                $this->view('layout/foot');
            }
        } else {
            $this->login();
        }
    }

    public function detsiswa($nis)
    {
        if ($_SESSION['userid']) {
            $data = [
                'menu' => $this->model('Base_model')->menu($_SESSION['role']),
                'siswa' => $this->model('Base_model')->detsiswa($nis),
                'title' => "Data Siswa"
            ];

            if (isset($_POST['save'])) {
                // Testing
                var_dump($_POST);
            } else {
                $this->view('layout/head', $data);
                $this->view('home/detsiswa', $data);
                $this->view('layout/foot');
            }
        } else {
            $this->login();
        }
    }

    public function absensi()
    {
        if ($_SESSION['userid']) {
            $data = [
                'menu' => $this->model('Base_model')->menu($_SESSION['role']),
                'title' => "Absensi Siswa",
                'kelas' => $this->model('Base_model')->get_kelas()
            ];

            if (isset($_POST['save'])) {
                for ($i = 0; $i <= count($_POST['nis']); $i++) :
                    if ($_POST['kehadiran'][$i] != "H" && $_POST['nis'][$i] != null) {
                        $query = "INSERT INTO `absen` (`time`, `nis`, `absen`, `ket`) VALUES (" . time() . "," . $_POST['nis'][$i] . "," . $_POST['kehadiran'][$i] . "," . $_POST['ket'][$i] . ")";
                        var_dump($query);
                    }
                endfor;
            } else {
                $this->view('layout/head', $data);
                $this->view('home/absensi', $data);
                $this->view('layout/foot');
            }
        } else {
            $this->login();
        }
    }

    public function countData()
    {
        echo json_encode($this->model('Base_model')->countData());
    }

    public function login()
    {
        if (isset($_POST['signin'])) {
            $this->model('Base_model')->cek_login();
        } else {
            $this->view('home/login');
        }
    }

    public function logout()
    {
        session_destroy();
        redirect();
        exit;
    }
}
