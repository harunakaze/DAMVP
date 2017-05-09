<?php
    class KategoriUtamaModel extends Model {
        public function selectKategoriWithKode($kode) {
            return DB::run("SELECT * FROM kategori_utama WHERE kode=?", [$kode])->fetch();
        }
    }
?>