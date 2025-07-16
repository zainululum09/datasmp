<?php
require_once __DIR__ . '/../models/SiswaModel.php';
require_once __DIR__ . '/../core/Auth.php';

class Siswa extends Controller{
    private $model;
    private $authUser;

    public function __construct($db)
    {
        $this->authUser = Auth::check($db);
        $this->model = new SiswaModel($db);
    }

    public function index()
    {
        $data = $this->model->getAll();
        echo json_encode(['status' => 'success', 'data' => $data,'user' => $this->authUser['username']]);
    }
    
    public function show($id)
    {
        $data = $this->model->getById($id);
        echo json_encode(['status' => 'success', 'data' => $data,'user' => $this->authUser['username']]);
    }
    
    public function kelas()
    {
        $data = $this->model->getKelas();
        echo json_encode(['status' => 'success', 'data' => $data,'user' => $this->authUser['username']]);
    }

    public function store()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Data tidak valid', 'user' => $this->authUser['username']]);
            return;
        }

        $result = $this->model->create([
            'nis'           => $data['nis'] ?? null,
            'nisn'          => $data['nisn'] ?? null,
            'nama'          => $data['nama'] ?? null,
            'jenis_kelamin' => $data['jenis_kelamin'] ?? null,
            'tempat_lahir'  => $data['tempat_lahir'] ?? null,
            'tanggal_lahir' => $data['tanggal_lahir'] ?? null,
            'no_hp'         => $data['no_hp'] ?? null,
            'alamat'        => $data['alamat'] ?? null,
        ]);

        if ($result > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Siswa ditambahkan', 'user' => $this->authUser['username']]);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan siswa', 'user' => $this->authUser['username']]);
        }
    }
    
    public function addKelas()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Data tidak valid', 'user' => $this->authUser['username']]);
            return;
        }

        $result = $this->model->addKelas([
            'nama_kelas'       => $data['nama_kelas'] ?? null,
            'tingkat'          => $data['tingkat'] ?? null,
            'tahun_ajaran_id'  => $data['tahun_ajaran_id'] ?? null,
        ]);

        if ($result > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Kelas ditambahkan', 'user' => $this->authUser['username']]);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan Kelas', 'user' => $this->authUser['username']]);
        }
    }

    public function update($id)
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data || !is_array($data)) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Data tidak valid', 'user' => $this->authUser['username']]);
            return;
        }

        $result = $this->model->update($id, $data);

        if ($result > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Siswa diperbarui', 'user' => $this->authUser['username']]);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Tidak ada perubahan atau siswa tidak ditemukan', 'user' => $this->authUser['username']]);
        }
    }
    
    public function updateKelas($id)
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data || !is_array($data)) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Data tidak valid', 'user' => $this->authUser['username']]);
            return;
        }

        $result = $this->model->editKelas($id, $data);

        if ($result > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Kelas diperbarui', 'user' => $this->authUser['username']]);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Tidak ada perubahan atau Kelas tidak ditemukan', 'user' => $this->authUser['username']]);
        }
    }


    public function delete($id)
    {
        $deleted = $this->model->delete($id);
        echo json_encode(['status' => 'deleted', 'result' => $deleted, 'user' => $this->authUser['username']]);
    }
    
    public function deleteKelas($id)
    {
        $deleted = $this->model->delKelas($id);
        echo json_encode(['status' => 'deleted', 'result' => $deleted, 'user' => $this->authUser['username']]);
    }

    public function anggota($id)
    {
        $data = $this->model->anggotaKelas($id);
        echo json_encode(['status' => 'success', 'data' => $data,'user' => $this->authUser['username']]);
    }

    public function siswaNon()
    {
        $data = $this->model->siswaNonKelas();
        echo json_encode(['status' => 'success', 'data' => $data,'user' => $this->authUser['username']]);
    }

    public function addSiswaKelas()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data['siswa_id'] || !$data['kelas_id']) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap','user' => $this->authUser['username']]);
            return;
        }

        $result = $this->model->tambahSiswaKeKelas($data);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Berhasil menambahkan siswa ke kelas', 'user' => $this->authUser['username']]);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan siswa ke kelas', 'user' => $this->authUser['username']]);
        }
    }

    public function remSiswaKelas($id)
    {
        $deleted = $this->model->delSiswaKelas($id);
        echo json_encode(['status' => 'deleted', 'result' => $deleted, 'user' => $this->authUser['username']]);
    }

    public function getSekolah()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");

        $keyword = $_GET['keyword'] ?? null;
        // var_dump($keyword);

        if (!$keyword || strlen($keyword) < 3) {
            http_response_code(400);
            echo json_encode([]);
            exit;
        }

        $encodedKeyword = urlencode($keyword);
        $url = "https://dapo.kemendikdasmen.go.id/api/getHasilPencarian?keyword=$encodedKeyword";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        // Decode JSON hasil dari API
        $data = json_decode($response, true);

        if (is_array($data)) {
            // Filter: hilangkan sekolah dengan nama diawali 'KB'
            $data = array_filter($data, function ($item) {
                return !preg_match('/^(KB|BKB)[\s\.\-]?/i', $item['nama_sekolah']);
            });
    
            // Sort: nama_sekolah > propinsi > kabupaten > kecamatan
            usort($data, function ($a, $b) {
                $cmp = strcasecmp($a['nama_sekolah'], $b['nama_sekolah']);
                if ($cmp !== 0) return $cmp;
    
                $cmp = strcasecmp($a['propinsi'], $b['propinsi']);
                if ($cmp !== 0) return $cmp;
    
                $cmp = strcasecmp($a['kabupaten'], $b['kabupaten']);
                if ($cmp !== 0) return $cmp;
    
                return strcasecmp($a['kecamatan'], $b['kecamatan']);
            });
    
            // Re-index array (opsional)
            $data = array_values($data);
        }

        // Kirim hasil yang sudah disortir
        echo json_encode($data);
    }

}
