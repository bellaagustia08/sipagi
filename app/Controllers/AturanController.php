<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\GejalaModel;
use App\Models\PenyakitModel;
use App\Models\AturanModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AturanController extends BaseController
{
    protected $aturan;

    public function __construct()
    {
        $this->users = new UsersModel();
        $this->gejala = new GejalaModel();
        $this->penyakit = new PenyakitModel();
        $this->aturan = new AturanModel();
    }

    public function index()
    {
        helper('form');
        if (($_SESSION['role']) == "Pakar") {
            $data['aturan'] = $this->aturan->orderBy('id_aturan', 'DESC')->findAll();
            $data['gejala'] = $this->gejala->findAll();
            $data['penyakit'] = $this->penyakit->findAll();
            $data['user'] = $this->users->getDataUser();

            return view('pakar/aturan/index', $data);
        } else {
            return redirect()->to('/dashboard');
        }
    }

    public function processTambah()
    {
        //ambil data dari masukan
        $id_gejala = $this->request->getPost('id_gejala');
        $id_penyakit = $this->request->getPost('id_penyakit');
        $cf_pakar = $this->request->getPost('cf_pakar');

        $total = count($id_gejala);
        for ($i = 0; $i < $total; $i++) {
            $data = [
                "id_gejala" => $id_gejala[$i],
                "id_penyakit" => $id_penyakit,
                "cf_pakar" => $cf_pakar[$i]
            ];

            //input ke tabel aturan
            $this->aturan->insertAturan($data);
        }

        session()->setFlashdata('success', 'Data Berhasil di tambah');
        return redirect()->to('/aturan');
    }

    public function processEdit()
    {
        //ambil data dari masukan
        $id_aturan = $this->request->getPost('id_aturan');
        $id_gejala = $this->request->getPost('id_gejala');
        $id_penyakit = $this->request->getPost('id_penyakit');
        $cf_pakar = $this->request->getPost('cf_pakar');

        /////////// simpan data aturan //////////
        $data = [
            "id_gejala" => $id_gejala,
            "id_penyakit" => $id_penyakit,
            "cf_pakar" => $cf_pakar
        ];

        //update ke tabel aturan
        $this->aturan->updateAturan($data, $id_aturan);

        session()->setFlashdata('success', 'Data Berhasil di ubah');
        return redirect()->to('/aturan');
    }

    public function delete()
    {
        $id = $this->request->getPost('id_aturan');
        $this->aturan->delete($id);

        session()->setFlashdata('deleted', 'Data Berhasil di hapus');
        return redirect()->to('/aturan');
    }
}
