<?php

namespace App\Models;

use CodeIgniter\Model;

class DokterModel extends Model
{
    protected $table = "dokter";
    protected $primaryKey = "id_dokter";
    protected $returnType = "object";
    protected $allowedFields = ['id_dokter', 'nama_dokter', 'alamat_dokter', 'no_telp_dokter'];

    public function getAll()
    {
        return $this->db->table($this->table)->orderBy('id_dokter', 'DESC')
            ->get()->getResultArray();
    }

    public function insertDokter($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateDokter($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id_Dokter' => $id));
        return $query;
    }

    public function deleteDokter($id)
    {
        $this->db->table($this->table)->where('id_dokter', $id);
        return $this->db->table($this->table)->delete($id);
    }
}
