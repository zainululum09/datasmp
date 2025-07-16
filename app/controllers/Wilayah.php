<?php

class Wilayah extends Controller{
    
    public function getProvinces()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");

        $data = file_get_contents("https://wilayah.id/api/provinces.json");
        echo $data;
    }

    public function getRegencies($provinceId)
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");

        if (!$provinceId) {
            http_response_code(400);
            echo json_encode(['error' => 'ID provinsi tidak valid']);
            exit;
        }

        $url = "https://wilayah.id/api/regencies/$provinceId.json";
        $data = file_get_contents($url);

        if ($data === false) {
            http_response_code(500);
            echo json_encode(['error' => 'Gagal mengambil data dari sumber']);
            exit;
        }

        echo $data;
    }

    public function getDistricts($districtId)
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");

        if (!$districtId) {
            http_response_code(400);
            echo json_encode(['error' => 'ID Kabupaten/Kota tidak valid']);
            exit;
        }

        $url = "https://wilayah.id/api/districts/$districtId.json";
        $data = file_get_contents($url);

        if ($data === false) {
            http_response_code(500);
            echo json_encode(['error' => 'Gagal mengambil data dari sumber']);
            exit;
        }

        echo $data;
    }

    public function getVillages($villageId)
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");

        if (!$villageId) {
            http_response_code(400);
            echo json_encode(['error' => 'ID Kecamatan tidak valid']);
            exit;
        }

        $url = "https://wilayah.id/api/villages/$villageId.json";
        $data = file_get_contents($url);

        if ($data === false) {
            http_response_code(500);
            echo json_encode(['error' => 'Gagal mengambil data dari sumber']);
            exit;
        }

        echo $data;
    }
}