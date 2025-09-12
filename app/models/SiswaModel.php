<?php
class SiswaModel
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM `peserta_didik` ORDER BY `nipd` ASC";
        $this->db->query($sql);
        return $this->db->resultset();
    }
    
    public function getById($id)
    {
        $this->db->query("SELECT * FROM `peserta_didik` WHERE peserta_didik_id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    public function getKelas()
    {
        $sql = "SELECT `rombongan_belajar`.`rombongan_belajar_id`, `rombongan_belajar`.`nama`, `rombongan_belajar`.`tingkat_pendidika_id`, `rombongan_belajar`.`semester_id`, `tahun_ajaran`.`nama` FROM `rombongan_belajar` JOIN `tahun_ajaran` ON `rombongan_belajar`.`semester_id` = `tahun_ajaran`.`nama` ORDER BY `rombongan_belajar`.`nama` ASC";
        $this->db->query($sql);
        return $this->db->resultset();
    }


    public function create($data)
    {
        $query = "INSERT INTO siswa (nipd, nisn, nama, jenis_kelamin, tempat_lahir, tanggal_lahir, no_hp, alamat, created_at, updated_at) 
                VALUES (:nipd, :nisn, :nama, :jenis_kelamin, :tempat_lahir, :tanggal_lahir, :no_hp, :alamat, NOW(), NOW())";

        $this->db->query($query);
        foreach ($data as $key => $val) {
            $this->db->bind(':' . $key, $val);
        }

        $this->db->execute();
        return $this->db->rowCount();
    }
    
    public function addKelas($data)
    {
        $query = "INSERT INTO kelas (nama_kelas, tingkat, tahun_ajaran_id, created_at, updated_at) 
                VALUES (:nama_kelas, :tingkat, :tahun_ajaran_id, NOW(), NOW())";

        $this->db->query($query);
        foreach ($data as $key => $val) {
            $this->db->bind(':' . $key, $val);
        }

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function tambahSiswaKeKelas($data)
    {
        $query = "INSERT INTO kelas_siswa (siswa_id, kelas_id, tahun_ajaran_id, created_at, updated_at) 
                VALUES (:siswa_id, :kelas_id, :tahun_ajaran_id, NOW(), NOW())";

        $this->db->query($query);
        // Bind data dengan validasi key yang benar
        $this->db->bind(':siswa_id', $data['siswa_id']);
        $this->db->bind(':kelas_id', $data['kelas_id']);
        $this->db->bind(':tahun_ajaran_id', $data['tahun_ajaran_id']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function update($id, $data)
    {
        $setParts = [];
        foreach ($data as $key => $value) {
            $setParts[] = "$key = :$key";
        }

        // Tambahkan updated_at
        $setParts[] = "updated_at = NOW()";
        $setQuery = implode(", ", $setParts);

        $query = "UPDATE siswa SET $setQuery WHERE id = :id";
        $this->db->query($query);

        foreach ($data as $key => $value) {
            $this->db->bind(":$key", $value);
        }

        $this->db->bind(":id", $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function editKelas($id, $data)
    {
        $setParts = [];
        foreach ($data as $key => $value) {
            $setParts[] = "$key = :$key";
        }

        // Tambahkan updated_at
        $setParts[] = "updated_at = NOW()";
        $setQuery = implode(", ", $setParts);

        $query = "UPDATE kelas SET $setQuery WHERE id = :id";
        $this->db->query($query);

        foreach ($data as $key => $value) {
            $this->db->bind(":$key", $value);
        }

        $this->db->bind(":id", $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function delete($id)
    {
        $this->db->query("DELETE FROM siswa WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function delKelas($id)
    {
        $this->db->query("DELETE FROM kelas WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function delSiswaKelas($id)
    {
        $this->db->query("DELETE FROM kelas_siswa WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function anggotaKelas($id)
    {
        // Query anggota kelas
        $this->db->query("SELECT siswa.id AS siswa_id, siswa.nama AS nama_siswa, siswa.jenis_kelamin AS jk, kelas.id AS kelas_id, kelas.tahun_ajaran_id AS ta, kelas.nama_kelas, kelas.tingkat, kelas_siswa.id AS kelasSiswaId FROM kelas_siswa JOIN siswa ON kelas_siswa.siswa_id = siswa.id JOIN kelas ON kelas_siswa.kelas_id = kelas.id WHERE kelas_id = :id ORDER BY nama_siswa ASC");
        $this->db->bind(':id', $id);
        $result = $this->db->resultset();

        // Jika tidak ada anggota, ambil data kelas saja
        if (empty($result)) {
            $this->db->query("SELECT id AS kelas_id, tahun_ajaran_id AS ta, nama_kelas, tingkat FROM kelas WHERE id = :id");
            $this->db->bind(':id', $id);
            $result = $this->db->resultset(); // tetap kembalikan dalam bentuk array
        }

        return $result;
    }

    public function siswaNonKelas()
    {
        $this->db->query("SELECT siswa.id AS siswa_id, siswa.nama AS nama_siswa, siswa.jenis_kelamin AS jk, kelas_siswa.kelas_id AS kelas_id FROM siswa LEFT JOIN kelas_siswa ON siswa.id = kelas_siswa.siswa_id WHERE kelas_siswa.id IS NULL ORDER BY `nama_siswa` ASC");
        return $this->db->resultset();
    }

}
