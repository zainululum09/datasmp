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
        echo json_encode([
            'status' => 'success',
            'data' => $data,
            'user' => $this->authUser['username']
        ]);
    }

    // public function store()
    // {
    //     $input = json_decode(file_get_contents('php://input'), true);
    //     // var_dump($input); die;
    //     if ($this->model('SiswaModel')->create($input)) {
    //         echo json_encode(['status' => 'success', 'message' => 'Data berhasil ditambahkan']);
    //     } else {
    //         http_response_code(500);
    //         echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan data']);
    //     }
    // }

    // public function update($id)
    // {
    //     $input = json_decode(file_get_contents('php://input'), true);
    //     if ($this->model('SiswaModel')->update($id, $input)) {
    //         echo json_encode(['status' => 'success', 'message' => 'Data berhasil diperbarui']);
    //     } else {
    //         http_response_code(500);
    //         echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui data']);
    //     }
    // }

    // public function destroy($id)
    // {
    //     var_dump($id); die;
    //     if ($this->model('SiswaModel')->delete($id)) {
    //         echo json_encode(['status' => 'success', 'message' => 'Data berhasil dihapus']);
    //     } else {
    //         http_response_code(500);
    //         echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data']);
    //     }
    // }
}
