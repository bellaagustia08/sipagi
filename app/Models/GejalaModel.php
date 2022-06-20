<?php

namespace App\Models;

use CodeIgniter\Model;

class GejalaModel extends Model
{
    protected $table = "gejala";
    protected $primaryKey = "id_gejala";
    protected $returnType = "object";
    protected $allowedFields = ['id_gejala', 'kode_gejala', 'nama_gejala'];

    public function getAll()
    {
        return $this->db->table($this->table)
            ->get()->getResultArray();
    }

    public function insertGejala($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateGejala($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id_gejala' => $id));
        return $query;
    }

    public function deleteGejala($id)
    {
        $this->db->table($this->table)->where('id_gejala', $id);
        return $this->db->table($this->table)->delete($id);
    }
}
