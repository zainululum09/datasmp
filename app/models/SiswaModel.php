<?php
class SiswaModel
{

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM `siswa`";
        $this->db->query($sql);
        return $this->db->resultset();
    }

    public function getById($id)
    {
        $this->db->query("SELECT * FROM siswa WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }


    public function create($data)
    {
        $query = "INSERT INTO siswa (nis, nisn, nama, jenis_kelamin, tempat_lahir, tanggal_lahir, no_hp, alamat, created_at, updated_at) 
                VALUES (:nis, :nisn, :nama, :jenis_kelamin, :tempat_lahir, :tanggal_lahir, :no_hp, :alamat, NOW(), NOW())";

        $this->db->query($query);
        foreach ($data as $key => $val) {
            $this->db->bind(':' . $key, $val);
        }

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

    public function delete($id)
    {
        $this->db->query("DELETE FROM siswa WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

}
