<?php

namespace App\Models;

use CodeIgniter\Model;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class UsersModel extends Model
{
    protected $table = "users";
    protected $primaryKey = "id_user";
    protected $returnType = "object";
    protected $allowedFields = ['id_user', 'nama_lengkap', 'username', 'email', 'password', 'role', 'status'];

    public function getDataUser()
    {
        $id = session()->get('id_user'); // dapatkan id user yg login
        return $this->db->table($this->table)
            ->where('id_user', $id)
            ->get()->getResultArray();
    }

    public function registrasiUser($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateUser($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id_user' => $id));
        return $query;
    }

    public function deleteUser($id)
    {
        $this->db->table($this->table)->where('id_user', $id);
        return $this->db->table($this->table)->delete($id);
    }

    public function getById($id_user)
    {
        return $this->db->table($this->table)
            ->where('id_user', $id_user)
            ->get()->getRowArray();
    }

    public function getByEmail($email)
    {
        return $this->db->table($this->table)
            ->where('email', $email)
            ->get()->getRowArray();
    }

    public function getByUsername($username)
    {
        return $this->db->table($this->table)
            ->where('username', $username)
            ->get()->getRowArray();
    }
}
