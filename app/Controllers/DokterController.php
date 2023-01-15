<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\DokterModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use \AllowDynamicProperties;

#[AllowDynamicProperties]

class DokterController extends BaseController
{
    protected $dokter;

    public function __construct()
    {
        $this->users = new UsersModel();
        $this->dokter = new DokterModel();
    }

    public function index()
    {
        helper('form');
        if (($_SESSION['role']) == "Admin") {
            $data['dokter'] = $this->dokter->getAll();
            $data['user'] = $this->users->getDataUser();

            return view('admin/dokter/index', $data);
        } else {
            return redirect()->to('/dashboard');
        }
    }

    public function processTambah()
    {
        //ambil data dari masukan
        $nama_dokter = ucwords($this->request->getPost('nama_dokter'));
        $alamat_dokter = ucwords($this->request->getPost('alamat_dokter'));
        $no_telp_dokter = $this->request->getPost('no_telp_dokter');

        /////////// simpan data dokter //////////
        $data = [
            "nama_dokter" => $nama_dokter,
            "alamat_dokter" => $alamat_dokter,
            "no_telp_dokter" => $no_telp_dokter,
        ];

        //update ke tabel dokter
        $this->dokter->insertDokter($data);

        session()->setFlashdata('success', 'Data Berhasil di tambah');
        return redirect()->to('/dokter');
    }

    public function processEdit()
    {
        //ambil data dari masukan
        $id_dokter = $this->request->getPost('id_dokter');
        $nama_dokter = ucwords($this->request->getPost('nama_dokter'));
        $alamat_dokter = ucwords($this->request->getPost('alamat_dokter'));
        $no_telp_dokter = $this->request->getPost('no_telp_dokter');

        /////////// simpan data dokter //////////
        $data = [
            "nama_dokter" => $nama_dokter,
            "alamat_dokter" => $alamat_dokter,
            "no_telp_dokter" => $no_telp_dokter,
        ];

        //update ke tabel dokter
        $this->dokter->updateDokter($data, $id_dokter);

        session()->setFlashdata('success', 'Data Berhasil di ubah');
        return redirect()->to('/dokter');
    }

    public function delete()
    {
        $id = $this->request->getPost('id_dokter');
        $this->dokter->delete($id);

        session()->setFlashdata('deleted', 'Data Berhasil di hapus');
        return redirect()->to('/dokter');
    }
}
