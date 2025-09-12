<?php
require_once __DIR__ . '/../models/DapodikModel.php';
require_once __DIR__ . '/../core/Auth.php';

class Dapodik extends Controller{
    private $model;
    private $authUser;

    public function __construct($db)
    {
        // $this->authUser = Auth::check($db);
        $this->model = new DapodikModel($db);
    }

    private function callDapodik($endpoint)
    {
        $config = $this->model->getConfig();
        $token = $config['token'];
        $npsn  = $config['npsn'];

        $url = "http://localhost:5774/WebService/$endpoint?npsn=$npsn";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer $token",
            "Accept: application/json"
        ]);
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            http_response_code(500);
            echo json_encode(["error" => $error]);
            exit;
        }
        curl_close($ch);

        $data = json_decode($response, true);

        if (!$response || !isset($data['rows'])) {
            http_response_code(400);
            echo json_encode(["error" => "Data tidak valid"]);
            exit;
        }

        return $data;
    }

    // ========================= SEKOLAH =========================
    public function sekolah()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");

        $data = $this->callDapodik("getSekolah");
        echo json_encode([
            "status"  => "success",
            "results" => $data['results'] ?? count($data['rows']),
            "rows"    => $data['rows']
        ]);
    }

    public function saveSekolah()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");

        $input = json_decode(file_get_contents("php://input"), true);
        if (!$input || !isset($input['rows'])) {
            http_response_code(400);
            echo json_encode(["error" => "Data tidak valid"]);
            return;
        }

        echo json_encode($input['rows']);

        try {
            $this->model->insertOrUpdateSekolah($input['rows']);
            echo json_encode(["status" => "success", "inserted" => count($input['rows'])]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["error" => $e->getMessage()]);
        }
    }

    // ========================= GTK =========================
    public function gtk()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");

        $data = $this->callDapodik("getGtk");
        echo json_encode([
            "status"  => "success",
            "results" => $data['results'] ?? count($data['rows']),
            "rows"    => $data['rows']
        ]);
    }

    public function saveGtk()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");

        $input = json_decode(file_get_contents("php://input"), true);
        if (!$input || !isset($input['rows'])) {
            http_response_code(400);
            echo json_encode(["error" => "Data tidak valid"]);
            return;
        }

        try {
            $this->model->insertOrUpdateGtk($input['rows']);
            echo json_encode(["status" => "success", "inserted" => count($input['rows'])]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["error" => $e->getMessage()]);
        }
    }

    // ========================= ROMBEL =========================
    public function rombel()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");

        $data = $this->callDapodik("getRombonganBelajar");
        echo json_encode([
            "status"  => "success",
            "results" => $data['results'] ?? count($data['rows']),
            "rows"    => $data['rows']
        ]);
    }

    public function saveRombel()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");

        $input = json_decode(file_get_contents("php://input"), true);
        if (!$input || !isset($input['rows'])) {
            http_response_code(400);
            echo json_encode(["error" => "Data tidak valid"]);
            return;
        }

        try {
            $this->model->insertOrUpdateRombel($input['rows']);
            echo json_encode(["status" => "success", "inserted" => count($input['rows'])]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["error" => $e->getMessage()]);
        }
    }

    // ========================= SISWA =========================
    public function siswa()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");

        $data = $this->callDapodik("getPesertaDidik");
        echo json_encode([
            "status"  => "success",
            "results" => $data['results'] ?? count($data['rows']),
            "rows"    => $data['rows']
        ]);
    }

    public function saveSiswa()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");

        $input = json_decode(file_get_contents("php://input"), true);
        if (!$input || !isset($input['rows'])) {
            http_response_code(400);
            echo json_encode(["error" => "Data tidak valid"]);
            return;
        }

        try {
            $this->model->insertOrUpdateSiswa($input['rows']);
            echo json_encode(["status" => "success", "inserted" => count($input['rows'])]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["error" => $e->getMessage()]);
        }
    }

    // ========================= User =========================
    public function userGtk()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");

        $data = $this->callDapodik("getPengguna");
        echo json_encode([
            "status"  => "success",
            "results" => $data['results'] ?? count($data['rows']),
            "rows"    => $data['rows']
        ]);
    }

    public function saveUserGtk()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");

        $input = json_decode(file_get_contents("php://input"), true);
        if (!$input || !isset($input['rows'])) {
            http_response_code(400);
            echo json_encode(["error" => "Data tidak valid"]);
            return;
        }

        try {
            $this->model->insertOrUpdatePengguna($input['rows']);
            echo json_encode(["status" => "success", "inserted" => count($input['rows'])]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["error" => $e->getMessage()]);
        }
    }

}
