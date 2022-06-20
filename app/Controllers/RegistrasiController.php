<?php

namespace App\Controllers;

use App\Models\UsersModel;

class RegistrasiController extends BaseController
{
    public function __construct()
    {
        $this->users = new UsersModel();
        $this->email = \Config\Services::email();
    }

    public function index()
    {
        helper('form');
        $data['user'] = $this->users->getDataUser();
        return view('auth/registrasi', $data);
    }

    public function indexProfilUser()
    {
        helper('form');
        $data['user'] = $this->users->getDataUser();
        return view('auth/profil', $data);
    }

    public function indexUbahKataSandi()
    {
        helper('form');
        $data['user'] = $this->users->getDataUser();
        return view('auth/ubahkatasandi', $data);
    }

    public function process()
    {
        //ambil data dari masukan
        $nama_lengkap = $this->request->getPost('nama_lengkap');
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = md5($this->request->getPost('password'));
        $role = $this->request->getPost('role');
        $status = $this->request->getPost('status');

        if ($this->users->getByUsername($username) == null) {
            if ($this->users->getByEmail($email) == null) {
                $data = [
                    "nama_lengkap" => $nama_lengkap,
                    "username" => $username,
                    "email" => $email,
                    "password" => $password,
                    "role" => $role,
                    "status" => $status,
                ];

                //input ke tabel users
                $this->users->registrasiUser($data);

                session()->setFlashdata('success', 'Anda Berhasil Registrasi');
                return redirect()->to('/registrasi');
            } else {
                session()->setFlashdata('error', 'Email Tersebut Sudah Digunakan!');
                return redirect()->back()->withInput();
            }
        } else {
            session()->setFlashdata('error', 'Nama Pengguna Tersebut Sudah Digunakan!');
            return redirect()->back()->withInput();
        }
    }

    public function processEditProfil()
    {
        //ambil data dari masukan
        $id_user = $this->request->getPost('id_user');
        $nama_lengkap = $this->request->getPost('nama');
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $role = $this->request->getPost('role');
        $status = $this->request->getPost('status');

        $temp_user = $this->users->where('id_user', $id_user)->first();
        if ($temp_user->email == $email) {
            $data = [
                "nama_lengkap" => $nama_lengkap,
                "username" => $username,
                "email" => $email,
                "role" => $role,
                "status" => $status,
            ];
            //update ke tabel user
            $this->users->updateUser($data, $id_user);

            session()->setFlashdata('success', 'Data Berhasil di ubah');
            session()->set([
                'id_user' => $id_user,
                'nama_lengkap' => $data['nama_lengkap'],
                'username' => $data['username'],
                'email' => $data['email'],
                'role' => $data['role'],
                'status' => $data['status'],
                'logged_in' => TRUE
            ]);

            return redirect()->to('/profil');
        } else {
            if ($this->users->getByEmail($email) == null) {
                $data = [
                    "nama_lengkap" => $nama_lengkap,
                    "username" => $username,
                    "email" => $email,
                    "role" => $role,
                    "status" => $status,
                ];
                //update ke tabel user
                $this->users->updateUser($data, $id_user);

                session()->setFlashdata('success', 'Data Berhasil di ubah');
                session()->set([
                    'id_user' => $id_user,
                    'nama_lengkap' => $data['nama_lengkap'],
                    'username' => $data['username'],
                    'email' => $data['email'],
                    'role' => $data['role'],
                    'status' => $data['status'],
                    'logged_in' => TRUE
                ]);

                return redirect()->to('/profil');
            } else {
                session()->setFlashdata('error_email', 'Email Tersebut Sudah Digunakan!');
                return redirect()->back()->withInput();
            }
        }
    }

    public function processUbahKataSandi()
    {
        //ambil data dari masukan
        $id_user = $this->request->getPost('id_user');
        $nama_lengkap = $this->request->getPost('nama_lengkap');
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $role = $this->request->getPost('role');
        $status = $this->request->getPost('status');

        $password_lama = md5($this->request->getPost('password_lama'));
        $password_baru = md5($this->request->getPost('password_baru'));
        $password_konfirmasi = md5($this->request->getPost('password_konfirmasi'));

        $cekPasswordLama = $this->users->getById($id_user);
        $temp = $cekPasswordLama['password'];

        if ($password_lama == $temp) {
            if ($password_baru == $password_konfirmasi) {
                $data = [
                    "nama_lengkap" => $nama_lengkap,
                    "username" => $username,
                    "email" => $email,
                    "password" => $password_baru,
                    "role" => $role,
                    "status" => $status,
                ];
                //update ke tabel user
                $this->users->updateUser($data, $id_user);

                session()->setFlashdata('success', 'Anda Berhasil Mengubah Kata Sandi');
                session()->set([
                    'id_user' => $id_user,
                    'nama_lengkap' => $data['nama_lengkap'],
                    'username' => $data['username'],
                    'email' => $data['email'],
                    'role' => $data['role'],
                    'status' => $data['status'],
                    'logged_in' => TRUE
                ]);

                return redirect()->to('/ubahKataSandi');
            } else {
                session()->setFlashdata('error', 'Kata Sandi Tidak Sama');
                return redirect()->back()->withInput();
            }
        } else {
            session()->setFlashdata('error', 'Anda Salah Memasukan Kata Sandi Lama');
            return redirect()->back()->withInput();
        }
    }



    public function processLupaPassword()
    {
        $to_email = $this->request->getPost('email');
        $findemail = $this->users->getByEmail($to_email);

        if ($findemail) {
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

            function generate_string($input, $strength = 16)
            {
                $input_length = strlen($input);
                $random_string = '';
                for ($i = 0; $i < $strength; $i++) {
                    $random_character = $input[mt_rand(0, $input_length - 1)];
                    $random_string .= $random_character;
                }

                return $random_string;
            }

            $passwordplain = generate_string($permitted_chars, 6) . '123';

            //update ke tabel user
            $data = [
                "password" => md5($passwordplain)
            ];
            $this->users->updateUser($data, $findemail['id_user']);

            $mail_message = 'Hallo ' . $findemail['nama_lengkap'] . ',' . "\r\n";
            $mail_message .= '<br>Thanks for contacting regarding to forgot password,<br><br> <b> Your temporary password </b> is <b>' . $passwordplain . '</b>' . "\r\n";
            $mail_message .= '<br><br>Silahkan perbaharui kata sandi anda.';
            $mail_message .= '<br><br>----------------------------------------------------';
            $mail_message .= '<br>Thanks & Regards';
            $mail_message .= '<br>SiPaGi';

            $email = service('email');
            $email->setTo($to_email);
            $email->setFrom('noreply@' . $_SERVER['SERVER_NAME'], 'Sipagi');
            $email->setSubject('Atur ulang kata sandi');
            $email->setMessage($mail_message);

            if ($email->send()) {
                // echo "Email successfully sent to $to_email...";
                session()->setFlashdata('success', 'Atur ulang kata sandi berhasil dikirim ke email ' . $to_email);
                return redirect()->back()->withInput();
            } else {
                // echo "Email sending failed...";
                session()->setFlashdata('error', 'Gagal mengirim atur ulang kata sandi ke email anda! silahkan coba lagi.');
                return redirect()->back()->withInput();
            }
        } else {
            session()->setFlashdata('warning', 'Email Tidak Terdaftar! silahkan coba lagi.');
            return redirect()->back();
        }
    }
}
