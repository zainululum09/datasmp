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
        echo json_encode(['status' => 'success', 'data' => $data]);
    }

    public function show($id)
    {
        $data = $this->model->getById($id);
        echo json_encode(['status' => 'success', 'data' => $data]);
    }

    public function store()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Data tidak valid']);
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
            echo json_encode(['status' => 'success', 'message' => 'Siswa ditambahkan']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan siswa']);
        }
    }

    public function update($id)
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data || !is_array($data)) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Data tidak valid']);
            return;
        }

        $result = $this->model->update($id, $data);

        if ($result > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Siswa diperbarui']);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Tidak ada perubahan atau siswa tidak ditemukan']);
        }
    }


    public function destroy($id)
    {
        $deleted = $this->model->delete($id);
        echo json_encode(['status' => 'deleted', 'result' => $deleted]);
    }

}
