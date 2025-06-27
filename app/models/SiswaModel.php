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
        $stmt = "SELECT * FROM siswa WHERE id = :id";
        $this->db->query($stmt);
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function create($data)
    {
        // var_dump($data);
        $stmt = "INSERT INTO siswa (nis, nisn, nama, jenis_kelamin, tempat_lahir, tanggal_lahir, no_hp, alamat) VALUES (:nis, :nisn, :nama, :jenis_kelamin, :tempat_lahir, :tanggal_lahir, :no_hp, :alamat)";
        $this->db->query($stmt);
        $this->db->bind('nis', $data['nis']);
        $this->db->bind('nisn', $data['nisn']);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('jenis_kelamin', $data['jenis_kelamin']);
        $this->db->bind('tempat_lahir', $data['tempat_lahir']);
        $this->db->bind('tanggal_lahir', $data['tanggal_lahir']);
        $this->db->bind('no_hp', $data['no_hp']);
        $this->db->bind('alamat', $data['alamat']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function update($id, $data)
    {
        $stmt ="UPDATE siswa SET nama = ?, umur = ?, alamat = ? WHERE id = :id";
        $this->db->query($stmt);
        $this->db->bind('id', $data['id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function delete($id)
    {
        $stmt = "DELETE FROM siswa WHERE id = :id";
        $this->db->query($stmt);
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
