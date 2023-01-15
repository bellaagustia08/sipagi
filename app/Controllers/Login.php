<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\PasienModel;
use App\Models\DokterModel;
use App\Models\JadwalModel;
use App\Models\GejalaModel;
use App\Models\PenyakitModel;
use App\Models\AturanModel;

use \AllowDynamicProperties;

#[AllowDynamicProperties]

class Login extends BaseController
{
    public function __construct()
    {
        $this->users = new UsersModel();
        $this->pasien = new PasienModel();
        $this->dokter = new DokterModel();
        $this->jadwal = new JadwalModel();
        $this->gejala = new GejalaModel();
        $this->penyakit = new PenyakitModel();
        $this->aturan = new AturanModel();
    }

    public function index()
    {
        helper('form');
        if (!isset($_SESSION['username'])) {
            return view('auth/halamanLogin');
        } else {
            return redirect()->to('/dashboard');
        }
    }

    public function process()
    {
        $username = $this->request->getVar('username');
        $password = md5($this->request->getVar('password'));
        $dataUser = $this->users->where([
            'username' => $username,
        ])->first();

        if ($dataUser) {
            if ($dataUser->status == "Aktif") {
                if ($password == $dataUser->password) {
                    session()->set([
                        'id_user' => $dataUser->id_user,
                        'nama_lengkap' => $dataUser->nama_lengkap,
                        'username' => $dataUser->username,
                        'email' => $dataUser->email,
                        'role' => $dataUser->role,
                        'status' => $dataUser->status,
                        'logged_in' => TRUE
                    ]);
                    return redirect()->to('/dashboard');
                } else {
                    session()->setFlashdata('error', 'Kata Sandi Salah');
                    return redirect()->back()->withInput();
                }
            } else {
                session()->setFlashdata('error', 'Akun Anda Belum Aktif. Tidak Bisa Login!');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('error', 'Nama Pengguna Tidak Terdaftar');
            return redirect()->back()->withInput();
        }
    }

    function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
