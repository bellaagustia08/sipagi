<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\PasienModel;
use App\Models\DokterModel;
use App\Models\JadwalModel;
use App\Models\GejalaModel;
use App\Models\PenyakitModel;
use App\Models\AturanModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use \AllowDynamicProperties;

#[AllowDynamicProperties]

class DashboardController extends BaseController
{
    protected $user;

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

    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////// BAGIAN ADMIN ////////////////////////////////
    //////////////////////////////////////////////////////////////////////////

    public function index()
    {
        helper('form');
        $data['user'] = $this->users->getDataUser();
        $data['allUser'] = $this->users->findAll();
        $data['pasien'] = $this->pasien->findAll();
        $data['dokter'] = $this->dokter->findAll();
        $data['jadwal'] = $this->jadwal->findAll();
        $data['gejala'] = $this->gejala->findAll();
        $data['penyakit'] = $this->penyakit->findAll();
        $data['aturan'] = $this->aturan->findAll();

        return view('dashboard/index', $data);
    }
}
