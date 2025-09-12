<?php

class DapodikModel
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getConfig()
    {
        $this->db->query("SELECT * FROM api");
        return $this->db->single();
    }

    /**
     * =======================
     * SEKOLAH
     * =======================
     */
    public function insertOrUpdateSekolah($rows)
    {
        $allowedFields = [
            "sekolah_id", "nama", "nss", "npsn", "bentuk_pendidikan_id",
            "bentuk_pendidikan_id_str", "status_sekolah", "status_sekolah_str",
            "alamat_jalan", "rt", "rw", "kode_wilayah", "kode_pos",
            "nomor_telepon", "nomor_fax", "email", "website", "is_sks",
            "lintang", "bujur", "dusun", "desa_kelurahan",
            "kecamatan", "kabupaten_kota", "provinsi"
        ];

        $sql = "INSERT INTO sekolah 
            (".implode(", ", $allowedFields).")
            VALUES 
            (:".implode(", :", $allowedFields).")
            ON DUPLICATE KEY UPDATE " . implode(", ", array_map(fn($f) => "$f = VALUES($f)", array_slice($allowedFields, 1)));

        $this->db->query($sql);

        foreach ($rows as $row) {
            $filtered = array_intersect_key($row, array_flip($allowedFields));
            foreach ($allowedFields as $field) {
                $this->db->bind(":$field", $filtered[$field] ?? null);
            }
            $this->db->execute();
        }
        return true;
    }

    public function deleteSekolah($id)
    {
        $sql = "DELETE FROM sekolah WHERE sekolah_id = :id";
        $this->db->query($sql);
        $this->db->bind(":id", $id);
        return $this->db->execute();
    }

    /**
     * =======================
     * PENGGUNA
     * =======================
     */
    public function insertOrUpdatePengguna($rows)
    {
        $allowedFields = [
            "pengguna_id",
            "ptk_id",
            "username",
            "nama",
            "peran_id_str",
            "password"
        ];

        // Bangun query sekali saja
        $sql = "INSERT INTO pengguna 
            (" . implode(", ", $allowedFields) . ")
            VALUES 
            (:" . implode(", :", $allowedFields) . ")
            ON DUPLICATE KEY UPDATE " . implode(", ", array_map(
                fn($f) => "$f = VALUES($f)",
                array_filter($allowedFields, fn($f) => $f !== "pengguna_id") // jangan update PK
            ));

        // Kalau input hanya single row, ubah jadi array
        if (isset($rows['pengguna_id'])) {
            $rows = [$rows];
        }

        // Jalankan insert/update untuk setiap row
        foreach ($rows as $row) {
            $this->db->query($sql);

            // Filter hanya field yang diizinkan
            $filtered = array_intersect_key($row, array_flip($allowedFields));

            // Bind semua field
            foreach ($allowedFields as $field) {
                $this->db->bind(":$field", $filtered[$field] ?? null);
            }

            $this->db->execute();
        }

        return true;
    }

    public function deletePengguna($id)
    {
        $sql = "DELETE FROM pengguna WHERE pengguna_id = :id";
        $this->db->query($sql);
        $this->db->bind(":id", $id);
        return $this->db->execute();
    }

    /**
     * =======================
     * GTK
     * =======================
     */
    public function insertOrUpdateGtk($rows)
    {
        $allowedFields = [
            "ptk_id",
            "nama",
            "jenis_kelamin",
            "tempat_lahir",
            "tanggal_lahir",
            "agama_id",
            "agama_id_str",
            "nuptk",
            "nik",
            "jenis_ptk_id",
            "jenis_ptk_id_str",
            "jabatan_ptk_id",
            "jabatan_ptk_id_str",
            "status_kepegawaian_id",
            "status_kepegawaian_id_str",
            "nip",
            "pendidikan_terakhir",
            "bidang_studi_terakhir",
            "pangkat_golongan_terakhir"
        ];

        $sql = "INSERT INTO gtk 
            (".implode(", ", $allowedFields).")
            VALUES 
            (:".implode(", :", $allowedFields).")
            ON DUPLICATE KEY UPDATE " . implode(", ", array_map(fn($f) => "$f = VALUES($f)", array_slice($allowedFields, 1)));

        $this->db->query($sql);

        foreach ($rows as $row) {
            $filtered = array_intersect_key($row, array_flip($allowedFields));
            foreach ($allowedFields as $field) {
                $this->db->bind(":$field", $filtered[$field] ?? null);
            }
            $this->db->execute();
        }
        return true;
    }

    public function deleteGtk($id)
    {
        $sql = "DELETE FROM gtk WHERE ptk_terdaftar_id = :id";
        $this->db->query($sql);
        $this->db->bind(":id", $id);
        return $this->db->execute();
    }

    /**
     * =======================
     * ROMBONGAN BELAJAR
     * =======================
     */
    public function insertOrUpdateRombel($rows)
    {
        // field rombel
        $rombelFields = [
            "rombongan_belajar_id",
            "nama",
            "tingkat_pendidikan_id",
            "tingkat_pendidikan_id_str",
            "semester_id",
            "jenis_rombel",
            "jenis_rombel_str",
            "kurikulum_id",
            "kurikulum_id_str",
            "id_ruang",
            "id_ruang_str",
            "moving_class",
            "ptk_id"
        ];

        // field anggota_rombel
        $anggotaFields = [
            "anggota_rombel_id",
            "rombongan_belajar_id",
            "peserta_didik_id",
            "jenis_pendaftaran_id",
            "jenis_pendaftaran_id_str"
        ];

        // SQL rombel
        $sqlRombel = "INSERT INTO rombongan_belajar (".implode(", ", $rombelFields).")
                    VALUES (:".implode(", :", $rombelFields).")
                    ON DUPLICATE KEY UPDATE " . implode(", ", array_map(fn($f) => "$f = VALUES($f)", array_slice($rombelFields, 1)));

        // SQL anggota rombel
        $sqlAnggota = "INSERT INTO anggota_rombel (".implode(", ", $anggotaFields).")
                    VALUES (:".implode(", :", $anggotaFields).")
                    ON DUPLICATE KEY UPDATE " . implode(", ", array_map(fn($f) => "$f = VALUES($f)", array_slice($anggotaFields, 1)));

        // Insert semua rombel
        foreach ($rows as $row) {
        /** ===================== * Cek rombongan_belajar * ===================== */
            $this->db->query("SELECT * FROM rombongan_belajar WHERE rombongan_belajar_id = :rombongan_belajar_id");
            $this->db->bind(":rombongan_belajar_id", $row['rombongan_belajar_id']);
            $rombonganBelajar = $this->db->single();

            if (!$rombonganBelajar) {
                /** ===================== * Insert rombongan_belajar * ===================== */
                $this->db->query($sqlRombel);
                $filteredRombel = array_intersect_key($row, array_flip($rombelFields));
                foreach ($rombelFields as $f) {
                $this->db->bind(":$f", $filteredRombel[$f] ?? null);
                }
                $this->db->execute();
            }
        }

        // Insert anggota_rombel
        foreach ($rows as $row) {
        if (!empty($row['anggota_rombel'])) {
            foreach ($row['anggota_rombel'] as $anggota) {
            /** ===================== * Cek peserta_didik * ===================== */
            $this->db->query("SELECT * FROM peserta_didik WHERE peserta_didik_id = :peserta_didik_id");
            $this->db->bind(":peserta_didik_id", $anggota['peserta_didik_id']);
            $pesertaDidik = $this->db->single();

            if ($pesertaDidik) {
                /** ===================== * Insert anggota rombel baru * ===================== */
                $this->db->query($sqlAnggota);
                // gabungkan dengan rombongan_belajar_id induk
                $dataAnggota = array_merge($anggota, [ "rombongan_belajar_id" => $row['rombongan_belajar_id'] ]);
                $filteredAnggota = array_intersect_key($dataAnggota, array_flip($anggotaFields));
                foreach ($anggotaFields as $f) {
                $value = !empty($filteredAnggota[$f]) ? $filteredAnggota[$f] : null;
                $this->db->bind(":$f",$value);
                }
                $this->db->execute();
            }
            }
        }
        }

        return true;
    }


    public function deleteRombel($id)
    {
        $sql = "DELETE FROM rombongan_belajar WHERE rombongan_belajar_id = :id";
        $this->db->query($sql);
        $this->db->bind(":id", $id);
        return $this->db->execute();
    }

    /**
     * =======================
     * PESERTA DIDIK
     * =======================
     */
    public function insertOrUpdateSiswa($rows)
    {
        $allowedFieldsSiswa = [
            "registrasi_id","jenis_pendaftaran_id","jenis_pendaftaran_id_str",
            "nipd","tanggal_masuk_sekolah","sekolah_asal","peserta_didik_id","nama",
            "nisn","jenis_kelamin","nik","tempat_lahir","tanggal_lahir","agama_id",
            "agama_id_str","nomor_telepon_rumah","nomor_telepon_seluler","nama_ayah",
            "pekerjaan_ayah_id","pekerjaan_ayah_id_str","nama_ibu","pekerjaan_ibu_id",
            "pekerjaan_ibu_id_str","nama_wali","pekerjaan_wali_id","pekerjaan_wali_id_str",
            "anak_keberapa","tinggi_badan","berat_badan","email","kebutuhan_khusus"
        ];

        $allowedFieldsRombel = [
            "rombongan_belajar_id","nama_rombel","tingkat_pendidikan_id",
            "semester_id","jenis_rombel","kurikulum_id","id_ruang","ptk_id"
        ];

        $allowedFieldsAnggota = [
            "anggota_rombel_id","rombongan_belajar_id",
            "peserta_didik_id","jenis_pendaftaran_id","jenis_pendaftaran_id_str"
        ];

        // SQL untuk siswa
        $sqlSiswa = "INSERT INTO peserta_didik (".implode(", ", $allowedFieldsSiswa).")
            VALUES (:".implode(", :", $allowedFieldsSiswa).")
            ON DUPLICATE KEY UPDATE " . implode(", ", array_map(fn($f)=>"$f=VALUES($f)", array_slice($allowedFieldsSiswa,1)));

        // SQL untuk rombel
        $sqlRombel = "INSERT INTO rombongan_belajar (".implode(", ", $allowedFieldsRombel).")
            VALUES (:".implode(", :", $allowedFieldsRombel).")
            ON DUPLICATE KEY UPDATE " . implode(", ", array_map(fn($f)=>"$f=VALUES($f)", array_slice($allowedFieldsRombel,1)));

        // SQL untuk anggota_rombel
        $sqlAnggota = "INSERT INTO anggota_rombel (".implode(", ", $allowedFieldsAnggota).")
            VALUES (:".implode(", :", $allowedFieldsAnggota).")
            ON DUPLICATE KEY UPDATE " . implode(", ", array_map(fn($f)=>"$f=VALUES($f)", array_slice($allowedFieldsAnggota,1)));

        foreach ($rows as $row) {
            // simpan peserta_didik
            $this->db->query($sqlSiswa);
            $filteredSiswa = array_intersect_key($row, array_flip($allowedFieldsSiswa));
            foreach ($allowedFieldsSiswa as $f) {
                $this->db->bind(":$f", $filteredSiswa[$f] ?? null);
            }
            $this->db->execute();

            // kalau ada rombel, pastikan rombel disimpan dulu
            // if (!empty($row['rombongan_belajar_id'])) {
            //     $this->db->query($sqlRombel);
            //     $filteredRombel = array_intersect_key($row, array_flip($allowedFieldsRombel));
            //     foreach ($allowedFieldsRombel as $f) {
            //         $this->db->bind(":$f", $filteredRombel[$f] ?? null);
            //     }
            //     $this->db->execute();
            // }

            // simpan anggota_rombel
            // if (!empty($row['anggota_rombel_id'])) {
            //     $this->db->query($sqlAnggota);
            //     $filteredAnggota = array_intersect_key($row, array_flip($allowedFieldsAnggota));
            //     foreach ($allowedFieldsAnggota as $f) {
            //         $this->db->bind(":$f", $filteredAnggota[$f] ?? null);
            //     }
            //     $this->db->execute();
            // }
        }

        return true;
    }

    public function deleteSiswa($id)
    {
        $sql = "DELETE FROM peserta_didik WHERE peserta_didik_id = :id";
        $this->db->query($sql);
        $this->db->bind(":id", $id);
        return $this->db->execute();
    }
}
