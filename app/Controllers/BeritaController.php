<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\BeritaModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class BeritaController extends BaseController
{
    protected $berita;

    public function __construct()
    {
        $this->users = new UsersModel();
        $this->berita = new BeritaModel();
    }

    public function index()
    {
        helper('form');

        if (($_SESSION['role']) == "Admin") {
            $data['berita'] = $this->berita->orderBy('id_berita', 'DESC')->findAll();
            $data['user'] = $this->users->getDataUser();

            return view('admin/berita/index', $data);
        } else {
            return redirect()->to('/dashboard');
        }
    }

    public function processTambah()
    {
        //ambil data dari masukan
        $judul_berita = $this->request->getPost('judul_berita');
        $isi_berita = $this->request->getPost('isi_berita');
        $sumber_berita = $this->request->getPost('sumber_berita');
        $gambar_berita = $this->request->getPost('url_gambar_berita');
        $status_berita = $this->request->getPost('status_berita');

        /////////// simpan data berita //////////
        $data = [
            "judul_berita" => $judul_berita,
            "isi_berita" => $isi_berita,
            "sumber_berita" => $sumber_berita,
            "gambar_berita" => $gambar_berita,
            "status_berita" => $status_berita,
        ];

        //update ke tabel berita
        $this->berita->insertBerita($data);

        session()->setFlashdata('success', 'Data Berhasil di tambah');
        return redirect()->to('/berita');
    }

    public function processEdit()
    {
        //ambil data dari masukan
        $id_berita = $this->request->getPost('id_berita');
        $judul_berita = $this->request->getPost('judul_berita');
        $isi_berita = $this->request->getPost('isi_berita');
        $sumber_berita = $this->request->getPost('sumber_berita');
        $gambar_berita = $this->request->getPost('url_gambar_berita_edit');
        $status_berita = $this->request->getPost('status_berita');

        /////////// simpan data berita //////////
        $data = [
            "judul_berita" => $judul_berita,
            "isi_berita" => $isi_berita,
            "sumber_berita" => $sumber_berita,
            "gambar_berita" => $gambar_berita,
            "status_berita" => $status_berita,
        ];

        //update ke tabel berita
        $this->berita->updateBerita($data, $id_berita);

        session()->setFlashdata('success', 'Data Berhasil di ubah');
        return redirect()->to('/berita');
    }

    public function delete()
    {
        $id = $this->request->getPost('id_berita');
        $this->berita->delete($id);

        session()->setFlashdata('deleted', 'Data Berhasil di hapus');
        return redirect()->to('/berita');
    }
}
