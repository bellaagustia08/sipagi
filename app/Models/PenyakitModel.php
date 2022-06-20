<?php

namespace App\Models;

use CodeIgniter\Model;

class PenyakitModel extends Model
{
    protected $table = "penyakit";
    protected $primaryKey = "id_penyakit";
    protected $returnType = "object";
    protected $allowedFields = ['id_penyakit', 'kode_penyakit', 'nama_penyakit', 'definisi_penyakit', 'penanganan_penyakit', 'gambar_penyakit', 'nama_file'];

    public function getAll()
    {
        return $this->db->table($this->table)
            ->get()->getResultArray();
    }

    public function insertPenyakit($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updatePenyakit($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id_penyakit' => $id));
        return $query;
    }

    public function deletePenyakit($id)
    {
        $this->db->table($this->table)->where('id_penyakit', $id);
        return $this->db->table($this->table)->delete($id);
    }

    public function getById($id)
    {
        return $this->db->table($this->table)
            ->where('id_penyakit', $id)
            ->get()->getResultArray();
    }
}
