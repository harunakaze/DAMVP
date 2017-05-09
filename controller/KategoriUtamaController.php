<?php
class KategoriUtamaController extends Controller {
    public function index() {
        $model = $this->loadModel('kategoriUtama');
        $data = $model->selectKategoriWithKode("K22");

        $this->data['kodeKategori'] = $data['kode'];
        $this->data['kategori22'] = $data;

        $this->loadView("kategori");
    }
}
?>