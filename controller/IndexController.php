<?php
/*
    Semua controller dan model merupakan turunan class Controller atau model.
    Semua controller dan model belakangnya harus ada Controller dan Model, dan nama file = nama class.
    Contoh.: XController or XModel

    Untuk URL atau pemanggilan gak kata Controller dan Model tidak perlu disertakan.
    Sedangkan View, sebenarnya hanya template saja, jadi namanya sedikit lebih bebas, karena tidak ada class.

    Routing mirip CI dengan contoh format
    http://localhost/damvp/index.php/NAMA_CONTROLLER/NAMA_FUNGSI/parameter_1/parameter_2/parameter_N/?VARIABLE_GET=NILAI_BIASA
*/
class IndexController extends Controller {

    /*
        Secara default IndexController adalah controlelr utama, dengan index sebagai action utama.
        Bisa diganti di index.php utama.
    */
    public function index() {
        // Jika mau echo JSON bisa langsung aja 
        echo json_encode(array("contoh_json" => "nilai"));
        echo "<br>THIS <b>IS</b> THE DEFAULT ACTION<br>";

        // Data yang mau dikirim ke view, ditampung di variable $this->data dalam bentuk associative array
        // Nanti diakses, langsung pake nama-nya aja, silakan lihat view/index.php sebagai contoh
        $this->data['nama'] = "Ujang";

        // Load view pake fungsi loadView, parameternya masukin nama file di folder view tanpa ekstensi .php
        $this->loadView("index");
    }

    /*
        Untuk manggil ini bisa diakses dengan, contoh:
        http://localhost/damvp/index.php/index/wiwi/parameterA/parameterB/?me=wowow
    */
    public function wiwi($param1, $param2) {
        echo "NO WAY IN SEVEN HEAVEN<br>";
        echo "ISI PARAMETER 1 : " . $param1 . "<br>";
        echo "ISI PARAMETER 2 : " . $param2 . "<br>";

        echo "ISI VARIABLE GET['me'] : " . $_GET['me'];
    }
}
?>