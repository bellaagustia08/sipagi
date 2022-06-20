<?php

namespace App\Models;

use CodeIgniter\Model;

class AturanModel extends Model
{
    protected $table = "aturan";
    protected $primaryKey = "id_aturan";
    protected $returnType = "object";
    protected $allowedFields = ['id_aturan', 'id_gejala', 'id_penyakit', 'cf_pakar'];

    public function getAll()
    {
        return $this->db->table($this->table)
            ->get()->getResultArray();
    }

    public function insertAturan($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateAturan($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id_aturan' => $id));
        return $query;
    }

    public function deleteAturan($id)
    {
        $this->db->table($this->table)->where('id_aturan', $id);
        return $this->db->table($this->table)->delete($id);
    }

    public function getByIdPenyakit($id_penyakit)
    {
        return $this->db->table($this->table)
            ->where('id_penyakit', $id_penyakit)
            ->get()->getResultArray();
    }

    public function getByIdGejala($id_gejala)
    {
        return $this->db->table($this->table)
            ->where('id_gejala', $id_gejala)
            ->get()->getResultArray();
    }
}
