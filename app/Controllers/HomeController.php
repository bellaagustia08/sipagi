<?php

namespace App\Controllers;

use App\Models\AturanModel;
use App\Models\KonsultasiModel;
use App\Models\DetailKonsultasiModel;
use App\Models\GejalaModel;
use App\Models\PenyakitModel;
use App\Models\PasienModel;
use App\Models\DokterModel;
use App\Models\JadwalModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class HomeController extends BaseController
{
    public function __construct()
    {
        $this->konsultasi = new KonsultasiModel();
        $this->detail_konsultasi = new DetailKonsultasiModel();
        $this->gejala = new GejalaModel();
        $this->penyakit = new PenyakitModel();
        $this->aturan = new AturanModel();
        $this->pasien = new PasienModel();
        $this->dokter = new DokterModel();
        $this->jadwal = new JadwalModel();
    }


    public function indexHome()
    {
        helper('form');
        return view('main/home');
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // konsultasi
    public function index()
    {
        helper('form');
        $data['gejala'] = $this->gejala->findAll();
        $data['penyakit'] = $this->penyakit->findAll();
        $data['aturan'] = $this->aturan->findAll();
        $data['pasien'] = $this->pasien->findAll();

        return view('main/pengajuan/index', $data);
    }

    public function processKonsultasi()
    {
        // deklarasi
        $cekUnik = '';
        $no_tiket = '';

        while ($cekUnik == null) {
            // nomor tiket RANDOM 6 karakter berisikan kombinasi huruf dan angka
            $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $no_tiket_temp = substr(str_shuffle($permitted_chars), 0, 6);

            // cek unik nomor tiket
            $cekUnik = $this->konsultasi->cekUnikNomorTiket($no_tiket_temp);
            if ($cekUnik == null) {
                // nomor tiket yang fix
                $no_tiket = $no_tiket_temp;
                break;
            }
        }

        // ambil data dari masukan
        $waktu = $this->request->getPost('waktu');
        $id_pasien = $this->request->getPost('id_pasien');
        $nama = ucwords($this->request->getPost('nama'));
        $username_pasien = $this->request->getPost('username_pasien');
        $alamat = ucwords($this->request->getPost('alamat'));
        $no_telp = $this->request->getPost('no_telp');
        $tanggal_lahir = $this->request->getPost('tanggal_lahir');
        $umur = $this->request->getPost('umur');
        $jenis_kelamin = $this->request->getPost('jenis_kelamin');
        $cf_user = $this->request->getPost('cf_user[]');

        // cek jika pasien ditemukan atau tidak
        if ($this->pasien->getById($id_pasien) == null) {
            // cek username tidak boleh sama
            if ($this->pasien->getByUsername($username_pasien) == null) {
                ////////////////////// simpan data pasien //////////////////////
                $data = [
                    "nama_pasien" => $nama,
                    "username_pasien" => $username_pasien,
                    "alamat_pasien" => $alamat,
                    "no_telp_pasien" => $no_telp,
                    "tanggal_lahir_pasien" => $tanggal_lahir,
                    "umur_pasien" => $umur,
                    "jenis_kelamin_pasien" => $jenis_kelamin,
                ];

                ////////////////////// input ke tabel pasien //////////////////////
                $this->pasien->insertPasien($data);
                $id_pasien_konsultasi = $this->pasien->insertId();
            } else {
                session()->setFlashdata('error', 'Username sudah digunakan, gunakan username lain!');
                return redirect()->back()->withInput();
            }
        } else {
            $id_pasien_konsultasi = $id_pasien;
        }

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////// Proses Hitung //////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $totalgejala = count($this->gejala->getAll());
        $totalpenyakit = count($this->penyakit->getAll());
        $totalaturan = count($this->aturan->getAll());

        $arrayPenyakit = $this->penyakit->getAll();
        $arrayGejala = $this->gejala->getAll();
        $arrayAturan = $this->aturan->getAll();

        // arrayGejalaBaru (Data Gejala yang dialami) tampung id gejala dan masukan cf user dari masukan
        for ($i = 0; $i < $totalgejala; $i++) {
            $arrayGejalaBaru[$i] = [
                "id_gejala" => (int)$arrayGejala[$i]['id_gejala'],
                "cf_user" => (float)$cf_user[$i],
            ];
        }
        $totalArrayGejalaBaru = count($arrayGejalaBaru);
        // dd($arrayGejalaBaru);

        // arrayAturanBaru tampung data aturan lengkap, data aturan + cf user & cf kombinasi
        for ($i = 0; $i < $totalaturan; $i++) {
            for ($j = 0; $j < $totalArrayGejalaBaru; $j++) {
                if ($arrayAturan[$i]['id_gejala'] == $arrayGejalaBaru[$j]['id_gejala']) {
                    // tampung cf_user & hasil array CF KOMBINASI jika gejala di pilih
                    $cf_user = $arrayGejalaBaru[$j]['cf_user'];
                    $cf_kombinasi = $cf_user  * $arrayAturan[$i]['cf_pakar'];
                    // bikin  array aturan baru lengkap
                    $arrayAturanBaru[$i] = [
                        "id_aturan" => $arrayAturan[$i]['id_aturan'],
                        "id_gejala" => $arrayAturan[$i]['id_gejala'],
                        "id_penyakit" => $arrayAturan[$i]['id_penyakit'],
                        "cf_pakar" => $arrayAturan[$i]['cf_pakar'],
                        "cf_user" => $cf_user,
                        "cf_kombinasi" => $cf_kombinasi,
                    ];
                }
            }
        }
        // dd($arrayAturanBaru);
        $totalArrayAturanBaru = count($arrayAturanBaru);

        // cek disini untuk kontrol index array per-penyakit
        $cek = 0;
        $arrayPerPenyakit = [];

        // arrayPerPenyakit tampung data per penyakit dari masing-masing aturan
        for ($j = 0; $j < $totalpenyakit; $j++) {
            for ($k = 0; $k < $totalArrayAturanBaru; $k++) {
                if ($arrayPenyakit[$j]['id_penyakit'] == $arrayAturanBaru[$k]['id_penyakit']) {
                    $arrayPerPenyakit[$j][$cek] = $arrayAturanBaru[$k];
                    $cek++;
                }
            }
            $cek = 0;
        }
        // dd($arrayPerPenyakit);
        $totalArrayPerPenyakit = count($arrayPerPenyakit);


        /////////////////////////////////////////////////////////////////////////////
        ////////////////////// hitung cf gabungan per penyakit ////////////////////// 
        /////////////////////////////////////////////////////////////////////////////
        // index disini untuk kontrol index array per-penyakit saat proses hitung cf gabungan
        $index = 0;
        // cf_old untuk tampung nilai cf saat perhitungan while
        $cf_old = 0;

        for ($i = 0; $i < $totalArrayPerPenyakit; $i++) {
            $totalGejalaPerPenyakit = count($arrayPerPenyakit[$i]);
            while ($index != $totalGejalaPerPenyakit) {
                // hitung cf gabungan disini
                $temp_cf_gabungan = $cf_old + ($arrayPerPenyakit[$i][$index]['cf_kombinasi'] * (1 - $cf_old));
                $cf_old = $temp_cf_gabungan;

                $index++;
            }
            // agar mendappat id penyakit sebelum index penyakit yang lain maka index - 1, agar tidak offset
            $temp_id_penyakit = $arrayPerPenyakit[$i][$index - 1]['id_penyakit'];

            // simpan arrayCF_GabunganPerPenyakit
            $arrayCF_GabunganPerPenyakit[$i] = [
                "id_penyakit" => $temp_id_penyakit,
                "cf_gabungan" => $cf_old
            ];

            // reset index dan cf_old
            $cf_old = 0;
            $index = 0;
        }

        ////////////////////// sorting data dari persentase besar - kecil ////////////////////// 
        $cf_gabungan = array_column($arrayCF_GabunganPerPenyakit, 'cf_gabungan');
        array_multisort($cf_gabungan, SORT_DESC, $arrayCF_GabunganPerPenyakit);

        // dd($arrayCF_GabunganPerPenyakit);

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////// End Proses Hitung /////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        ////////////////////// simpan data konsultasi //////////////////////
        // hasil hipotesis dari perhitungan cf, ambil index nol karena paling tinggi hasil hipotesisnya dari hasil sort
        $id_penyakit_fix = $arrayCF_GabunganPerPenyakit[0]['id_penyakit'];
        $cf_gabungan_fix = $arrayCF_GabunganPerPenyakit[0]['cf_gabungan'];
        // dd($id_pasien_konsultasi);
        $data = [
            "no_tiket" => $no_tiket,
            "waktu" => $waktu,
            "id_penyakit" => $id_penyakit_fix,
            "cf_gabungan" => $cf_gabungan_fix,
            "id_pasien" => $id_pasien_konsultasi,
        ];

        ////////////////////// input ke tabel konsultasi //////////////////////
        $this->konsultasi->insertKonsultasi($data);
        $id_konsultasi = $this->konsultasi->insertId();

        ////////////////////// input ke tabel detail_konsultasi //////////////////////
        $totalArrayGejalaBaru = count($arrayGejalaBaru);
        for ($i = 0; $i < $totalArrayGejalaBaru; $i++) {
            // simpan data gejala yang dialami ke database detail_konsultasi
            if ($arrayGejalaBaru[$i]['cf_user'] != 0) {
                $dataDetailKonsultasi = [
                    "id_konsultasi" => $id_konsultasi,
                    "id_gejala" => $arrayGejala[$i]['id_gejala'],
                    "cf_user" => $arrayGejalaBaru[$i]['cf_user'],
                ];
                ////////////////////// input ke tabel detail_konsultasi //////////////////////
                $this->detail_konsultasi->insertDetailKonsultasi($dataDetailKonsultasi);
            }
        }

        session()->set([
            "no_tiket" => $no_tiket,
            "waktu" => $waktu,
            "id_pasien" => $id_pasien_konsultasi,
            "nama" => $nama,
            "alamat" => $alamat,
            "no_telp" => $no_telp,
            "tanggal_lahir" => $tanggal_lahir,
            "umur" => $umur,
            "jenis_kelamin" => $jenis_kelamin,
            'arrayCF_GabunganPerPenyakit' => $arrayCF_GabunganPerPenyakit,
        ]);

        return redirect()->to('/pengajuan/hasilKonsultasi');
    }

    public function halamanHasilKonsultasi()
    {
        if (session()->get('no_tiket') == null) {
            session()->setFlashdata('warning', 'Isi Data Pengajuan Konsultasi Terlebih Dahulu !');
            return redirect()->to('/pengajuan');
        } else {
            $no_tiket = session()->get('no_tiket');
            $data['konsultasi'] = $this->konsultasi->getByNomorTiket($no_tiket);
            $data['penyakit'] = $this->penyakit->findAll();
            $data['pasien'] = $this->pasien->findAll();

            return view('main/pengajuan/halamanHasilKonsultasi', $data);
        }
    }

    public function halamanCetakHasilKonsultasi()
    {
        if (session()->get('no_tiket') == null) {
            session()->setFlashdata('warning', 'Isi Data Pengajuan Konsultasi Terlebih Dahulu !');
            return redirect()->to('/pengajuan');
        } else {
            $no_tiket = session()->get('no_tiket');
            $data['konsultasi'] = $this->konsultasi->getByNomorTiket($no_tiket);
            $data['penyakit'] = $this->penyakit->findAll();
            $data['pasien'] = $this->pasien->findAll();

            session()->destroy();
            return view('main/pengajuan/cetakHasilPengajuan', $data);
        }
    }





    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // riwayat
    public function indexriwayat()
    {
        helper('form');
        $data['konsultasi'] = $this->konsultasi->orderBy('id_konsultasi', 'DESC')->findAll();
        $data['pasien'] = $this->pasien->findAll();
        $data['penyakit'] = $this->penyakit->findAll();
        $data['gejala'] = $this->gejala->findAll();
        return view('main/riwayat/index', $data);
    }

    public function detailriwayat($id_konsultasi)
    {
        helper('form');
        $temp_konsultasi = $this->konsultasi->where('id_konsultasi', $id_konsultasi)->first();
        $temp_pasien = $this->pasien->where('id_pasien', $temp_konsultasi->id_pasien)->first();

        $data['konsultasi'] = $temp_konsultasi;
        $data['detail_konsultasi'] = $this->detail_konsultasi->getByIdKonsultasi($id_konsultasi);
        $data['pasien'] = $temp_pasien;
        $data['penyakit'] = $this->penyakit->findAll();
        $data['gejala'] = $this->gejala->findAll();
        return view('main/riwayat/detail', $data);
    }


    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // download
    public function indexdownload()
    {
        helper('form');
        $data['konsultasi'] = $this->konsultasi->findAll();
        $data['pasien'] = $this->pasien->findAll();
        $data['penyakit'] = $this->penyakit->findAll();
        $data['gejala'] = $this->gejala->findAll();
        return view('main/download/index', $data);
    }

    public function cetakHasilDownload($no_tiket)
    {
        $temp_konsultasi = $this->konsultasi->where('no_tiket', $no_tiket)->first();

        $data['konsultasi'] = $temp_konsultasi;
        $data['penyakit'] = $this->penyakit->findAll();
        $data['gejala'] = $this->gejala->findAll();
        $data['pasien'] = $this->pasien->findAll();

        return view('main/download/cetakDownload', $data);
    }




    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // janji temu
    public function indexjanjitemu()
    {
        helper('form');
        $data['konsultasi'] = $this->konsultasi->findAll();
        $data['pasien'] = $this->pasien->findAll();
        $data['dokter'] = $this->dokter->findAll();
        $data['jadwal'] = $this->jadwal->findAll();

        return view('main/janjitemu/index', $data);
        // }
    }

    public function processjanjitemu()
    {
        //ambil data dari masukan
        $nama = ucwords($this->request->getPost('nama'));
        // username pasien di null kan untuk janji temu
        $username_pasien = null;
        $alamat = ucwords($this->request->getPost('alamat'));
        $no_telp = $this->request->getPost('no_telp');
        $tanggal_lahir = $this->request->getPost('tanggal_lahir');
        $umur = $this->request->getPost('umur');
        $jenis_kelamin = $this->request->getPost('jenis_kelamin');
        $jadwal = $this->request->getPost('jadwal');


        // cek jadwal terpilih
        if ($jadwal == null) {
            session()->setFlashdata('warning2', 'Pilih Jadwal Janji Temu Terlebih Dahulu !');
            return redirect()->back()->withInput();
        } else {
            $id_jadwal = (int)$jadwal[0][0];

            /////////// simpan data pasien //////////
            $data = [
                "nama_pasien" => $nama,
                "username_pasien" => $username_pasien,
                "alamat_pasien" => $alamat,
                "no_telp_pasien" => $no_telp,
                "tanggal_lahir_pasien" => $tanggal_lahir,
                "umur_pasien" => $umur,
                "jenis_kelamin_pasien" => $jenis_kelamin,
            ];

            //input ke tabel pasien
            $this->pasien->insertPasien($data);
            $id_pasien = $this->pasien->insertId();

            /////////// simpan data jadwal //////////
            $dataJadwal = [
                "id_pasien" => $id_pasien,
                "status" => "Aktif",
            ];

            //update ke tabel jadwal
            $this->jadwal->updateJadwal($dataJadwal, $id_jadwal);

            session()->set([
                "id_jadwal" => $id_jadwal,
                "id_pasien" => $id_pasien,
            ]);

            session()->setFlashdata('success', 'Permintaan Janji Temu Berhasil Dikirim');
            return redirect()->to('/janjitemu/hasilJanjiTemu');
        }
    }

    public function halamanHasilJanjiTemu()
    {
        if (session()->get('id_pasien') == null) {
            session()->setFlashdata('warning', 'Isi Data Permintaan Janji Temu Terlebih Dahulu !');
            return redirect()->to('/janjitemu');
        } else {
            $id_jadwal = session()->get('id_jadwal');
            $id_pasien = session()->get('id_pasien');
            $data['pasien'] = $this->pasien
                ->where('id_pasien', $id_pasien)
                ->findAll();
            $data['dokter'] = $this->dokter->findAll();
            $data['jadwal'] = $this->jadwal
                ->where('id_jadwal', $id_jadwal)
                ->findAll();
            return view('main/janjitemu/halamanHasilJanjiTemu', $data);
        }
    }

    public function halamanCetakHasilJanjiTemu()
    {
        if (session()->get('id_pasien') == null) {
            session()->setFlashdata('warning', 'Isi Data Permintaan Janji Temu Terlebih Dahulu !');
            return redirect()->to('/janjitemu');
        } else {
            $id_jadwal = session()->get('id_jadwal');
            $id_pasien = session()->get('id_pasien');
            $data['pasien'] = $this->pasien
                ->where('id_pasien', $id_pasien)
                ->findAll();
            $data['dokter'] = $this->dokter->findAll();
            $data['jadwal'] = $this->jadwal
                ->where('id_jadwal', $id_jadwal)
                ->findAll();

            // session()->get('id_pasien')->destroy();
            return view('main/janjitemu/cetakHasilJanjiTemu', $data);
        }
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}
