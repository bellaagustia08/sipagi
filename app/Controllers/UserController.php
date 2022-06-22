<?php

namespace App\Controllers;

use App\Models\UsersModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class UserController extends BaseController
{
    protected $user;

    public function __construct()
    {
        $this->users = new UsersModel();
    }

    public function index()
    {
        helper('form');
        $data['user'] = $this->users->findAll();
        return view('admin/user/index', $data);
    }

    // public function processTambah()
    // {
    //     //ambil data dari masukan
    //     $nama_lengkap = ucwords($this->request->getPost('nama_lengkap'));
    //     $role = ucwords($this->request->getPost('role'));
    //     $status = ucwords($this->request->getPost('status'));

    //     /////////// simpan data user //////////
    //     $data = [
    //         "nama_lengkap" => $nama_lengkap,
    //         "role" => $role,
    //         "status" => $status,
    //     ];

    //     //input ke tabel user
    //     $this->user->insertUser($data);

    //     session()->setFlashdata('success', 'Data Berhasil di tambah');
    //     return redirect()->to('/user');
    // }

    public function processEdit()
    {
        //ambil data dari masukan
        $id_user = $this->request->getPost('id_user');
        $nama_lengkap = ucwords($this->request->getPost('nama_lengkap'));
        $role = ucwords($this->request->getPost('role'));
        $status = ucwords($this->request->getPost('status'));

        /////////// simpan data user //////////
        $data = [
            "nama_lengkap" => $nama_lengkap,
            "role" => $role,
            "status" => $status,
        ];
        //update ke tabel user
        $this->users->updateUser($data, $id_user);

        session()->setFlashdata('success', 'Data Berhasil di ubah');
        return redirect()->to('/user');
    }

    public function delete()
    {
        $id = $this->request->getPost('id_user');
        $this->users->delete($id);

        session()->setFlashdata('deleted', 'Data Berhasil di hapus');
        return redirect()->to('/user');
    }
}
