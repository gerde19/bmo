<?php

namespace App\Controllers;

use App\Models\TabelData;
use CodeIgniter\Validation\Rules;

class Kapal extends BaseController
{

    protected $TabelData;
    public function __construct()
    {
        helper('form');
    }

    // Harga Kapal
    public function hargaKapal()
    {
        $model  = new TabelData();
        $data = [
            'kodeKapal' => $model->getKodeKapal(),
            'hargaKapal' => $model->getHargaKapal()
        ];
        // $builder    = $this->db->table('kode_kapal');
        // $query      = $builder->get()->getResult();
        // $data['kode_kapal'] = $query;
        return view('bmo/hargaKapal/index', $data);
    }

    public function hargaKapalAdd()
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to(base_url('hargaKapal'));
        }

        $validated = $this->validate([
            'hk_foto' => 'uploaded[hk_foto]|mime_in[hk_foto,image/jpg,image/gif,image/png,image/jpeg]|max_size[hk_foto,5000]'
        ]);

        if ($validated == FALSE) {
            return redirect()->to(base_url('hargaKapal'));
        } else {
            $file_gambar = $this->request->getFile('hk_foto');
            $file_gambar->move(ROOTPATH . 'public/kapal');

            $data = [
                'hk_kode' => $this->request->getPost('hk_kode'),
                'hk_nama' => $this->request->getPost('hk_nama'),
                'hk_harga' => $this->request->getPost('hk_harga'),
                'hk_diskon' => $this->request->getPost('hk_diskon'),
                'hk_status' => $this->request->getPost('hk_status'),
                'hk_foto' => $file_gambar->getName(),
            ];

            $this->db->table('harga_kapal')->insert($data);
            return redirect()->to(site_url('hargaKapal'))->with('success', 'Data Berhasil Disimpan!');
        }
    }

    public function hargaKapalEdit()
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to(base_url('hargaKapal'));
        }

        if ($this->request->getFile('hk_foto')->getName() == "") {
            $id = $this->request->getPost('hk_id');
            $data = [
                'hk_kode' => $this->request->getPost('hk_kode'),
                'hk_nama' => $this->request->getPost('hk_nama'),
                'hk_harga' => $this->request->getPost('hk_harga'),
                'hk_diskon' => $this->request->getPost('hk_diskon'),
                'hk_status' => $this->request->getPost('hk_status')
            ];
            $this->db->table('harga_kapal')->where(['hk_id' => $id])->update($data);
            return redirect()->to(site_url('hargaKapal'))->with('success', 'Data Berhasil Dirubah!');
        } else {
            $validated = $this->validate([
                'hk_foto' => 'uploaded[hk_foto]|mime_in[hk_foto,image/jpg,image/gif,image/png,image/jpeg]|max_size[hk_foto,5000]'
            ]);

            if ($validated == FALSE) {
                return redirect()->to(base_url('hargaKapal'));
                // echo "Data ada yang salah!";
            } else {
                $id = $this->request->getPost('hk_id');
                $file_gambar = $this->request->getFile('hk_foto');
                $file_gambar->move(ROOTPATH . 'public/kapal');
                $data = [
                    'hk_kode' => $this->request->getPost('hk_kode'),
                    'hk_nama' => $this->request->getPost('hk_nama'),
                    'hk_harga' => $this->request->getPost('hk_harga'),
                    'hk_diskon' => $this->request->getPost('hk_diskon'),
                    'hk_status' => $this->request->getPost('hk_status'),
                    'hk_foto' => $file_gambar->getName()
                ];
                $this->db->table('harga_kapal')->where(['hk_id' => $id])->update($data);
                return redirect()->to(site_url('hargaKapal'))->with('success', 'Data Berhasil Dirubah!');
            }
        }
    }

    // Detail Kapal
    public function detailKapal()
    {
        $model  = new TabelData();
        $data = [
            'kodeKapal' => $model->getKodeKapal(),
            'detailKapal' => $model->getDetailKapal()
        ];
        return view('bmo/detailKapal/index', $data);
    }

    public function detailKapalAdd()
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to(base_url('detailKapal'));
        }

        $validated = $this->validate([
            'dk_gambar' => 'uploaded[dk_gambar]|mime_in[dk_gambar,image/jpg,image/gif,image/png,image/jpeg]|max_size[dk_gambar,5000]'
        ]);

        if ($validated == FALSE) {
            return redirect()->to(base_url('detailKapal'));
        } else {
            $file_gambar = $this->request->getFile('dk_gambar');
            $file_gambar->move(ROOTPATH . 'public/kapal/detail');

            $data = [
                'dk_kode' => $this->request->getPost('dk_kode'),
                'dk_nama' => $this->request->getPost('dk_nama'),
                'dk_status' => $this->request->getPost('dk_status'),
                'dk_kapten' => $this->request->getPost('dk_kapten'),
                'dk_abk' => $this->request->getPost('dk_abk'),
                'dk_kapasitas' => $this->request->getPost('dk_kapasitas'),
                'dk_ac' => $this->request->getPost('dk_ac'),
                'dk_toilet' => $this->request->getPost('dk_toilet'),
                'dk_ruang' => $this->request->getPost('dk_ruang'),
                'dk_mesin' => $this->request->getPost('dk_mesin'),
                'dk_gambar' => $file_gambar->getName(),
            ];

            $this->db->table('detail_kapal')->insert($data);
            return redirect()->to(site_url('detailKapal'))->with('success', 'Data Berhasil Disimpan!');
        }
    }

    public function detailKapalEdit()
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to(base_url('detailKapal'));
        }

        if ($this->request->getFile('dk_gambar')->getName() == "") {
            $id = $this->request->getPost('dk_id');
            $data = [
                'dk_kode' => $this->request->getPost('dk_kode'),
                'dk_nama' => $this->request->getPost('dk_nama'),
                'dk_status' => $this->request->getPost('dk_status'),
                'dk_kapten' => $this->request->getPost('dk_kapten'),
                'dk_abk' => $this->request->getPost('dk_abk'),
                'dk_kapasitas' => $this->request->getPost('dk_kapasitas'),
                'dk_ac' => $this->request->getPost('dk_ac'),
                'dk_toilet' => $this->request->getPost('dk_toilet'),
                'dk_ruang' => $this->request->getPost('dk_ruang'),
                'dk_mesin' => $this->request->getPost('dk_mesin'),
            ];
            $this->db->table('detail_kapal')->where(['dk_id' => $id])->update($data);
            return redirect()->to(site_url('detailKapal'))->with('success', 'Data Berhasil Dirubah!');
        } else {
            $id = $this->request->getPost('dk_id');
            $query = $this->db->table('detail_kapal')->getWhere(['dk_id' => $id]);
            $ambil = $query->getRow();
            $validated = $this->validate([
                'dk_gambar' => 'uploaded[dk_gambar]|mime_in[dk_gambar,image/jpg,image/gif,image/png,image/jpeg]|max_size[dk_gambar,5000]'
            ]);

            if ($validated == FALSE) {
                return redirect()->to(base_url('detailKapal'))->with('error', 'Maaf Format File Salah!');;
                // echo "Data ada yang salah!";
            } else {
                if ($ambil->dk_gambar != "") {
                    $target_gambar = '../public/kapal/detail/' . $ambil->dk_gambar;
                    unlink($target_gambar);
                }
                $file_gambar = $this->request->getFile('dk_gambar');
                $file_gambar->move(ROOTPATH . 'public/kapal/detail');
                $data = [
                    'dk_kode' => $this->request->getPost('dk_kode'),
                    'dk_nama' => $this->request->getPost('dk_nama'),
                    'dk_status' => $this->request->getPost('dk_status'),
                    'dk_kapten' => $this->request->getPost('dk_kapten'),
                    'dk_abk' => $this->request->getPost('dk_abk'),
                    'dk_kapasitas' => $this->request->getPost('dk_kapasitas'),
                    'dk_ac' => $this->request->getPost('dk_ac'),
                    'dk_toilet' => $this->request->getPost('dk_toilet'),
                    'dk_ruang' => $this->request->getPost('dk_ruang'),
                    'dk_mesin' => $this->request->getPost('dk_mesin'),
                    'dk_gambar' => $file_gambar->getName(),
                ];
                $this->db->table('detail_kapal')->where(['dk_id' => $id])->update($data);
                return redirect()->to(site_url('detailKapal'))->with('success', 'Data Berhasil Dirubah!');
            }
        }
    }

    public function detailKapalDel()
    {
        $id = $this->request->getPost('dk_id');
        $query = $this->db->table('detail_kapal')->getWhere(['dk_id' => $id]);
        $ambil = $query->getRow();
        $target_gambar = '../public/kapal/detail/' . $ambil->dk_gambar;
        unlink($target_gambar);
        $this->db->table('detail_kapal')->where(['dk_id' => $id])->delete();
        return redirect()->to(site_url('detailKapal'))->with('success', 'Data Berhasil Dihapus!');
    }
}
