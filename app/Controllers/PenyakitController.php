<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\PenyakitModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Google\Cloud\Firestore\FirestoreClient;

class PenyakitController extends BaseController
{
    protected $penyakit;

    public function __construct()
    {
        $this->users = new UsersModel();
        $this->penyakit = new PenyakitModel();
    }

    public function index()
    {
        helper('form');
        if (($_SESSION['role']) == "Pakar") {
            $data['penyakit'] = $this->penyakit->orderBy('id_penyakit', 'DESC')->findAll();
            $data['user'] = $this->users->getDataUser();

            return view('pakar/penyakit/index', $data);
        } else {
            return redirect()->to('/dashboard');
        }
    }

    public function processTambah()
    {
        //ambil data dari masukan
        $nama_penyakit = $this->request->getPost('nama_penyakit');
        $definisi_penyakit = $this->request->getPost('definisi_penyakit');
        $penanganan_penyakit = $this->request->getPost('penanganan_penyakit');
        $gambar_penyakit = $this->request->getPost('url_gambar_penyakit');
        $nama_file = $this->request->getPost('nama_file');

        /////////// simpan data penyakit //////////
        $data = [
            "nama_penyakit" => $nama_penyakit,
            "definisi_penyakit" => $definisi_penyakit,
            "penanganan_penyakit" => $penanganan_penyakit,
            "gambar_penyakit" => $gambar_penyakit,
            "nama_file" => $nama_file,
        ];

        //input ke tabel penyakit
        $this->penyakit->insertPenyakit($data);

        $id = $this->penyakit->insertID();
        if ($id <= 9) {
            $kode_penyakit = 'P0' . $id;
        } else {
            $kode_penyakit = 'P' . $id;
        }

        $dataUpdate = [
            "kode_penyakit" => $kode_penyakit,
        ];

        $this->penyakit->updatePenyakit($dataUpdate, $id);

        session()->setFlashdata('success', 'Data Berhasil di tambah');
        return redirect()->to('/penyakit');
    }

    public function processEdit()
    {
        //ambil data dari masukan
        $id_penyakit = $this->request->getPost('id_penyakit');
        $nama_penyakit = $this->request->getPost('nama_penyakit');
        $definisi_penyakit = $this->request->getPost('definisi_penyakit');
        $penanganan_penyakit = $this->request->getPost('penanganan_penyakit');
        $gambar_penyakit = $this->request->getPost('url_gambar_penyakit_edit');
        $nama_file = $this->request->getPost('nama_file_edit');

        if ($gambar_penyakit == null) {
            $temp = $this->penyakit->where('id_penyakit', $id_penyakit)->first();
            $gambar_penyakit = $temp->gambar_penyakit;
            $nama_file = $temp->nama_file;
        }

        /////////// simpan data penyakit //////////
        $data = [
            "nama_penyakit" => $nama_penyakit,
            "definisi_penyakit" => $definisi_penyakit,
            "penanganan_penyakit" => $penanganan_penyakit,
            "gambar_penyakit" => $gambar_penyakit,
            "nama_file" => $nama_file,
        ];

        //update ke tabel penyakit
        $this->penyakit->updatePenyakit($data, $id_penyakit);

        session()->setFlashdata('success', 'Data Berhasil di ubah');
        return redirect()->to('/penyakit');
    }

    public function delete()
    {
        $id = $this->request->getPost('id_penyakit');
        $this->penyakit->delete($id);

        session()->setFlashdata('deleted', 'Data Berhasil di hapus');
        return redirect()->to('/penyakit');
    }
}
