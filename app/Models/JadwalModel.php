<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table = "jadwal";
    protected $primaryKey = "id_jadwal";
    protected $returnType = "object";
    protected $allowedFields = ['id_jadwal', 'tanggal_jadwal', 'waktu_jadwal', 'id_dokter', 'id_konsultasi', 'status'];

    public function getAll()
    {
        return $this->db->table($this->table)
            ->orderBy('id_jadwal', 'desc')
            ->get()->getResultArray();
    }

    public function insertJadwal($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateJadwal($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id_jadwal' => $id));
        return $query;
    }

    public function deleteJadwal($id)
    {
        $this->db->table($this->table)->where('id_jadwal', $id);
        return $this->db->table($this->table)->delete($id);
    }

    //belum kepake
    public function getAllJoinSesi()
    {
        return $this->db->table($this->table)
            ->join('sesi', 'jadwal.id_sesi=sesi.id_sesi')
            ->get()->getResultArray();
    }

    public function getAllJoinKonsultasi()
    {
        return $this->db->table($this->table)
            ->join('konsultasi', 'jadwal.id_konsultasi=konsultasi.id_konsultasi')
            ->get()->getResultArray();
    }

    public function getAllJoinDokter()
    {
        return $this->db->table($this->table)
            ->join('dokter', 'jadwal.id_dokter=dokter.id_dokter')
            ->get()->getResultArray();
    }
}
