<?php
class Controller {
    private $root_location;

    protected $data;

    public function __construct() {
        $this->root_location = dirname(__DIR__);
    }

    protected function loadModel($model) {
        $modelName = ucfirst($model).'Model';
        return new $modelName();
    }

    protected function loadView($view) {
        foreach($this->data as $key => $value) {
            ${$key} = $value;
        }
        
        include($this->root_location.'/view/'.$view.'.php');
    }
}
?>