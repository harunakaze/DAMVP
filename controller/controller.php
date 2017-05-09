<?php
class Controller {
    private $root_location;

    protected $data;

    public function __construct() {
        $this->root_location = dirname(__DIR__);
    }

    protected function loadModel($model) {
        //require_once($this->root_location.'/model/'.$model.'.php');
        // spl_autoload_register(function ($model) {
        //     include 'model/' . $model . '.php';
        // });

        $modelName = ucfirst($model).'Model';
        return new $modelName();
    }

    protected function loadView($view) {
        foreach($this->data as $key => $value) {
            ${$key} = $value;
        }

        require_once($this->root_location.'/view/'.$view.'.php');
    }
}
?>