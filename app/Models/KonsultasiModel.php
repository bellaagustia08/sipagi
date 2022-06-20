<?php

namespace App\Models;

use CodeIgniter\Model;

class KonsultasiModel extends Model
{
    protected $table = "konsultasi";
    protected $primaryKey = "id_konsultasi";
    protected $returnType = "object";
    protected $allowedFields = ['id_konsultasi', 'id_pasien', 'no_tiket', 'id_penyakit', 'cf_gabungan','waktu' ];

    public function getAll()
    {
        return $this->db->table($this->table)
            ->get()->getResultArray();
    }

    public function insertKonsultasi($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateKonsultasi($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id_konsultasi' => $id));
        return $query;
    }

    public function deleteKonsultasi($id)
    {
        $this->db->table($this->table)->where('id_konsultasi', $id);
        return $this->db->table($this->table)->delete($id);
    }

    // fungsi is unik untuk cek nomor tiket
    public function cekUnikNomorTiket($no_tiket)
    {
        return $this->db->table($this->table)
            ->where('no_tiket', $no_tiket)
            ->get()->getResultArray();
    }

    // get konsultasi by nomor tiket
    public function getByNomorTiket($no_tiket)
    {
        return $this->db->table($this->table)
            ->where('no_tiket', $no_tiket)
            ->get()->getResultArray();
    }

    // get konsultasi by username
    public function getByUsername($username)
    {
        return $this->db->table($this->table)
            ->where('username_pasien', $username)
            ->get()->getResultArray();
    }
}
