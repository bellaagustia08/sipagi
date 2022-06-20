<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailKonsultasiModel extends Model
{
    protected $table = "detail_konsultasi";
    protected $primaryKey = "id_detail_konsultasi";
    protected $returnType = "object";
    protected $allowedFields = ['id_detail_konsultasi', 'id_gejala', 'cf_user'];

    public function getAll()
    {
        return $this->db->table($this->table)
            ->get()->getResultArray();
    }

    public function insertDetailKonsultasi($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateDetailKonsultasi($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id_detail_konsultasi' => $id));
        return $query;
    }

    public function deleteDetailKonsultasi($id)
    {
        $this->db->table($this->table)->where('id_detail_konsultasi', $id);
        return $this->db->table($this->table)->delete($id);
    }

    public function getById($id)
    {
        return $this->db->table($this->table)
            ->where('id_detail_konsultasi', $id)
            ->get()->getResultArray();
    }

    public function getByIdKonsultasi($id)
    {
        return $this->db->table($this->table)
            ->where('id_konsultasi', $id)
            ->get()->getResultArray();
    }
}
