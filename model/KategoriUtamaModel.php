<?php
/*
    Model dibuat seindah mungkin, agar isinya cuma CRUD, dengan parameter yang sesuai, kayak tugas PSP :v
*/
class KategoriUtamaModel extends Model {
    public function selectKategoriWithKode($kode) {
        /*
            Untuk buat query silakan pake class singleton DB, yang tak adaptasi dari https://phpdelusions.net
            DB merupakan class wrapper untuk PDO
            
            Contoh lain penggunaan:
            https://phpdelusions.net/pdo/pdo_wrapper
        */
        return DB::run("SELECT * FROM kategori_utama WHERE kode=?", [$kode])->fetch();
    }
}
?>