<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\GejalaModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use \AllowDynamicProperties;

#[AllowDynamicProperties]

class GejalaController extends BaseController
{
    protected $gejala;

    public function __construct()
    {
        $this->users = new UsersModel();
        $this->gejala = new GejalaModel();
    }

    public function index()
    {
        helper('form');
        if (($_SESSION['role']) == "Pakar") {
            $data['gejala'] = $this->gejala->orderBy('id_gejala', 'DESC')->findAll();
            $data['user'] = $this->users->getDataUser();

            return view('pakar/gejala/index', $data);
        } else {
            return redirect()->to('/dashboard');
        }
    }

    public function processTambah()
    {
        //ambil data dari masukan
        $nama_gejala = $this->request->getPost('nama_gejala');

        /////////// simpan data gejala //////////
        $data = [
            "nama_gejala" => $nama_gejala,
        ];
        //input ke tabel gejala
        $this->gejala->insertGejala($data);

        $id = $this->gejala->insertID();
        if ($id <= 9) {
            $kode_gejala = 'G0' . $id;
        } else {
            $kode_gejala = 'G' . $id;
        }

        $dataUpdate = [
            "kode_gejala" => $kode_gejala,
        ];
        $this->gejala->updateGejala($dataUpdate, $id);

        session()->setFlashdata('success', 'Data Berhasil di tambah');
        return redirect()->to('/gejala');
    }

    public function processEdit()
    {
        //ambil data dari masukan
        $id_gejala = $this->request->getPost('id_gejala');
        $nama_gejala = $this->request->getPost('nama_gejala');

        /////////// simpan data gejala //////////
        $data = [
            "nama_gejala" => $nama_gejala,
        ];

        //update ke tabel gejala
        $this->gejala->updateGejala($data, $id_gejala);

        session()->setFlashdata('success', 'Data Berhasil di ubah');
        return redirect()->to('/gejala');
    }

    public function delete()
    {
        $id = $this->request->getPost('id_gejala');
        $this->gejala->delete($id);

        session()->setFlashdata('deleted', 'Data Berhasil di hapus');
        return redirect()->to('/gejala');
    }
}
