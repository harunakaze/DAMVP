<?php
class IndexController extends Controller {
    public function index() {
        echo "THIS IS MY SIN";
    }
    public function wiwi($param1, $param2) {
        echo "NO WAY IN SEVEN HEAVEN";
        echo $param1;
        echo $param2;

        echo $_GET['me'];
    }
}
?>