<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\PasienModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PasienController extends BaseController
{
    protected $pasien;

    public function __construct()
    {
        $this->users = new UsersModel();
        $this->pasien = new PasienModel();
    }

    public function index()
    {
        helper('form');

        if (($_SESSION['role']) == "Admin") {
            $data['pasien'] = $this->pasien->orderBy('id_pasien', 'DESC')->findAll();
            $data['user'] = $this->users->getDataUser();

            return view('admin/pasien/index', $data);
        } else {
            return redirect()->to('/dashboard');
        }
    }

    public function processTambah()
    {
        //ambil data dari masukan
        $nama_pasien = ucwords($this->request->getPost('nama_pasien'));
        $username_pasien = $this->request->getPost('username_pasien');
        $alamat_pasien = ucwords($this->request->getPost('alamat_pasien'));
        $no_telp_pasien = $this->request->getPost('no_telp_pasien');
        $tanggal_lahir_pasien = $this->request->getPost('tanggal_lahir_pasien');
        $umur_pasien = $this->request->getPost('umur_pasien');
        $jenis_kelamin_pasien = $this->request->getPost('jenis_kelamin_pasien');

        if ($this->pasien->getByUsername($username_pasien) == null) {
            /////////// simpan data pasien //////////
            $data = [
                "nama_pasien" => $nama_pasien,
                "username_pasien" => $username_pasien,
                "alamat_pasien" => $alamat_pasien,
                "no_telp_pasien" => $no_telp_pasien,
                "tanggal_lahir_pasien" => $tanggal_lahir_pasien,
                "umur_pasien" => $umur_pasien,
                "jenis_kelamin_pasien" => $jenis_kelamin_pasien,
            ];

            //input ke tabel pasien
            $this->pasien->insertPasien($data);

            session()->setFlashdata('success', 'Data Berhasil di tambah');
            return redirect()->to('/pasien');
        } else {
            session()->setFlashdata('warning', 'Nama unik sudah digunakan! Masukan nama unik lain.');
            return view('admin/pasien/index');
        }
    }

    public function processEdit()
    {
        //ambil data dari masukan
        $id_pasien = $this->request->getPost('id_pasien');
        $nama_pasien = ucwords($this->request->getPost('nama_pasien'));
        $username_pasien = $this->request->getPost('username_pasien');
        $alamat_pasien = ucwords($this->request->getPost('alamat_pasien'));
        $no_telp_pasien = $this->request->getPost('no_telp_pasien');
        $tanggal_lahir_pasien = $this->request->getPost('tanggal_lahir_pasien');
        $umur_pasien = $this->request->getPost('umur_pasien');
        $jenis_kelamin_pasien = $this->request->getPost('jenis_kelamin_pasien');

        if ($this->pasien->getByUsername($username_pasien) == null) {
            /////////// simpan data pasien //////////
            $data = [
                "nama_pasien" => $nama_pasien,
                "username_pasien" => $username_pasien,
                "alamat_pasien" => $alamat_pasien,
                "no_telp_pasien" => $no_telp_pasien,
                "tanggal_lahir_pasien" => $tanggal_lahir_pasien,
                "umur_pasien" => $umur_pasien,
                "jenis_kelamin_pasien" => $jenis_kelamin_pasien,
            ];

            //update ke tabel pasien
            $this->pasien->updatePasien($data, $id_pasien);

            session()->setFlashdata('success', 'Data Berhasil di ubah');
            return redirect()->to('/pasien');
        } else {
            session()->setFlashdata('warning', 'Nama unik sudah digunakan! Masukan nama unik lain.');
            return redirect()->to('/pasien');
        }
    }

    public function delete()
    {
        $id = $this->request->getPost('id_pasien');
        $this->pasien->delete($id);

        session()->setFlashdata('deleted', 'Data Berhasil di hapus');
        return redirect()->to('/pasien');
    }
}
