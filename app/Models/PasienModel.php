<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienModel extends Model
{
    protected $table = "pasien";
    protected $primaryKey = "id_pasien";
    protected $returnType = "object";
    protected $allowedFields = ['id_pasien', 'nama_pasien', 'username_pasien', 'alamat_pasien', 'no_telp_pasien', 'tanggal_lahir_pasien', 'umur_pasien', 'jenis_kelamin_pasien',];

    public function getAll()
    {
        return $this->db->table($this->table)
            ->get()->getResultArray();
    }

    public function insertPasien($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updatePasien($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id_pasien' => $id));
        return $query;
    }

    public function deletePasien($id)
    {
        $this->db->table($this->table)->where('id_pasien', $id);
        return $this->db->table($this->table)->delete($id);
    }

    // untuk cek id pasien di pengajuan konsultasi
    public function getByNama($nama)
    {
        return $this->db->table($this->table)
            ->where('nama_pasien', $nama)
            ->get()->getResultArray();
    }

    public function getById($id)
    {
        return $this->db->table($this->table)
            ->where('id_pasien', $id)
            ->get()->getResultArray();
    }

    public function getByUsername($username)
    {
        return $this->db->table($this->table)
            ->where('username_pasien', $username)
            ->get()->getResultArray();
    }
}
