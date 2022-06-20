<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\DokterModel;
use App\Models\PasienModel;
use App\Models\JadwalModel;

class JadwalController extends BaseController
{
    protected $jadwal;

    public function __construct()
    {
        $this->users = new UsersModel();
        $this->dokter = new DokterModel();
        $this->jadwal = new JadwalModel();
        $this->pasien = new PasienModel();
    }

    public function index()
    {
        helper('form');
        if (($_SESSION['role']) == "Admin") {
            $data['jadwal'] = $this->jadwal->orderBy('id_jadwal', 'DESC')->getAll();
            $data['pasien'] = $this->pasien->findAll();
            $data['dokter'] = $this->dokter->getAll();

            return view('admin/jadwal/index', $data);
        } else {
            return redirect()->to('/dashboard');
        }
    }

    public function processTambah()
    {
        //ambil data dari masukan
        $tanggal_jadwal = $this->request->getPost('tanggal_jadwal');
        $format = date('Y-m-d', strtotime($tanggal_jadwal));
        $waktu_jadwal = $this->request->getPost('waktu_jadwal');
        $id_dokter = $this->request->getPost('id_dokter');
        $id_pasien = $this->request->getPost('id_pasien');
        $status = $this->request->getPost('status');

        /////////// simpan data jadwal //////////
        $data = [
            "tanggal_jadwal" => $format,
            "waktu_jadwal" => $waktu_jadwal,
            "id_dokter" => $id_dokter,
            "id_pasien" => $id_pasien,
            "status" => $status,
        ];

        //input ke tabel jadwal
        $this->jadwal->insertJadwal($data);

        session()->setFlashdata('success', 'Data Berhasil di tambah');
        return redirect()->to('/jadwal');
    }

    public function processEdit()
    {
        //ambil data dari masukan
        $id_jadwal = $this->request->getPost('id_jadwal');
        $tanggal_jadwal = $this->request->getPost('tanggal_jadwal');
        $waktu_jadwal = $this->request->getPost('waktu_jadwal');
        $format = date('Y-m-d', strtotime($tanggal_jadwal));
        $id_dokter = $this->request->getPost('id_dokter');
        $id_pasien = $this->request->getPost('id_pasien');
        $status = $this->request->getPost('status');

        /////////// simpan data jadwal //////////
        $data = [
            "tanggal_jadwal" => $format,
            "waktu_jadwal" => $waktu_jadwal,
            "id_dokter" => $id_dokter,
            "id_pasien" => $id_pasien,
            "status" => $status,
        ];

        //update ke tabel jadwal
        $this->jadwal->updateJadwal($data, $id_jadwal);

        session()->setFlashdata('success', 'Data Berhasil di ubah');
        return redirect()->to('/jadwal');
    }

    public function delete()
    {
        $id = $this->request->getPost('id_jadwal');

        $temp_jadwal = $this->jadwal->where('id_jadwal', $id)->first();
        $temp_pasien = $this->pasien->where('id_pasien', $temp_jadwal->id_pasien)->first();

        $this->jadwal->delete($id);
        $this->pasien->delete($temp_pasien->id_pasien);

        session()->setFlashdata('deleted', 'Data Berhasil di hapus');
        return redirect()->to('/jadwal');
    }
}
