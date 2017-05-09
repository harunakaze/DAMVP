<?php
class KategoriUtamaController extends Controller {
    public function index() {
        // Pake model dengan fungsi loadModel, parameternya nama file di folder model, tanpa tambahan kata Model
        $model = $this->loadModel('kategoriUtama');

        // Akses seperti object biasa
        $data = $model->selectKategoriWithKode("K22");

        $this->data['kodeKategori'] = $data['kode'];
        $this->data['kategori22'] = $data;

        $this->loadView("kategori");
    }
}
?>