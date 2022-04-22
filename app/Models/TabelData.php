<?php

namespace App\Models;

use CodeIgniter\Model;

class TabelData extends Model
{
    public function getKodeKapal()
    {
        return $this->db->table('kode_kapal')
            ->orderBy("kk_kode ASC")
            ->get()->getResultArray();
    }

    public function getHargaKapal()
    {
        return $this->db->table('harga_kapal')
            ->join('kode_kapal', 'kode_kapal.kk_id=harga_kapal.hk_kode')
            ->get()->getResultArray();
    }

    public function getDetailKapal()
    {
        return $this->db->table('detail_kapal')
            ->join('kode_kapal', 'kode_kapal.kk_id=detail_kapal.dk_kode')
            ->get()->getResultArray();
    }
}
