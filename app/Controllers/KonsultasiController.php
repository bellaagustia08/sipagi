<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\KonsultasiModel;
use App\Models\PenyakitModel;
use App\Models\PasienModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class KonsultasiController extends BaseController
{
    protected $konsultasi;

    public function __construct()
    {
        $this->users = new UsersModel();
        $this->konsultasi = new KonsultasiModel();
        $this->penyakit = new PenyakitModel();
        $this->pasien = new PasienModel();
    }

    public function index()
    {
        helper('form');

        // if (($_SESSION['role']) == "Admin") {
        //     $data['konsultasi'] = $this->konsultasi->findAll();
        //     $data['penyakit'] = $this->penyakit->findAll();
        //     $data['user'] = $this->users->getDataUser();

        //     return view('admin/konsultasi/index', $data);
        // } else {
        //     return redirect()->to('/dashboard');
        // }

        $data['konsultasi'] = $this->konsultasi->findAll();
        $data['penyakit'] = $this->penyakit->findAll();
        $data['pasien'] = $this->pasien->findAll();
        $data['user'] = $this->users->getDataUser();

        return view('admin/konsultasi/index', $data);
    }

    public function processEdit()
    {
        //ambil data dari masukan
        $id_konsultasi = $this->request->getPost('id_konsultasi');
        $no_tiket = $this->request->getPost('no_tiket');
        $id_pasien = $this->request->getPost('id_pasien');
        $nama = $this->request->getPost('nama');
        $alamat = $this->request->getPost('alamat');
        $no_telp = $this->request->getPost('no_telp');
        $tanggal_lahir = $this->request->getPost('tanggal_lahir');
        $id_penyakit = $this->request->getPost('id_penyakit');
        $cf_gabungan = $this->request->getPost('cf_gabungan');
        $persentase = $this->request->getPost('persentase');

        /////////// simpan data konsultasi //////////
        if ($id_pasien == NULL) {
            $data = [
                "no_tiket" => $no_tiket,
                "id_pasien" => NULL,
                "nama" => $nama,
                "alamat" => $alamat,
                "no_telp" => $no_telp,
                "tanggal_lahir" => $tanggal_lahir,
                "id_penyakit" => $id_penyakit,
                "cf_gabungan" => $cf_gabungan,
                "persentase" => $persentase,
            ];
        } else {
            $data = [
                "no_tiket" => $no_tiket,
                "id_pasien" => $id_pasien,
                "nama" => $nama,
                "alamat" => $alamat,
                "no_telp" => $no_telp,
                "tanggal_lahir" => $tanggal_lahir,
                "id_penyakit" => $id_penyakit,
                "cf_gabungan" => $cf_gabungan,
                "persentase" => $persentase,
            ];
        }


        //update ke tabel konsultasi
        $this->konsultasi->updateKonsultasi($data, $id_konsultasi);

        session()->setFlashdata('success', 'Data Berhasil di ubah');
        return redirect()->to('/konsultasi');
    }

    public function delete()
    {
        $id = $this->request->getPost('id_konsultasi');
        $this->konsultasi->delete($id);

        session()->setFlashdata('deleted', 'Data Berhasil di hapus');
        return redirect()->to('/konsultasi');
    }
}
