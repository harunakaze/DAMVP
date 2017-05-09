<?php
    // -- ######################## --
    // --         #     # #   #    --
    // --        #     # #  #      --
    // --       ####### # #        --
    // --      ####### # #         --
    // --     #     # #  #         --
    // --    #     # #   #         --
    // -- ######################## --
    // Saka Wibawa Putra 2017
    
    require_once('config/include.php');
    class DAMVP {
        const DEFAULT_CONTROLLER = "index";
        const DEFAULT_ACTION = "index";

        protected $controller;
        protected $action        = self::DEFAULT_ACTION;
        protected $params        = array();
        protected $baseLocation  = "damvp";
        protected $baseAccess    = "/index.php";

        public function __construct() {
            $this->parseUri();
        }

        protected function parseUri() {
            $path = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");

            $path = preg_replace('/[^a-zA-Z0-9]\//', "", $path);

            if (strpos($path, $this->baseLocation) === 0) {
                $path = substr($path, strlen($this->baseLocation));
            }

            if (strpos($path, $this->baseAccess) === 0) {
                $path = substr($path, strlen($this->baseAccess));
            }

            // Trim request, especially preceding "/"
            $path = trim($path, "/");

            @list($controller, $action, $params) = explode("/", $path, 3);

            if (isset($controller) && !empty($controller)) {
                $this->setController($controller);
            } else {
                // A bug, setController must always be called.
                $this->setController(self::DEFAULT_CONTROLLER);
            }
            if (isset($action)) {
                $this->setAction($action);
            }
            if (isset($params)) {
                $this->setParams(explode("/", $params));
            }
        }

        public function setController($controller) {
            $controller = ucfirst($controller) . 'Controller';
            if (!class_exists($controller)) {
                throw new InvalidArgumentException(
                    "The controller '$controller' has not been defined.");
            }
            $this->controller = $controller;
            return $this;
        }

        public function setAction($action) {
            $reflector = new ReflectionClass($this->controller);
            if (!$reflector->hasMethod($action)) {
                throw new InvalidArgumentException(
                    "The controller action '$action' has been not defined.");
            }
            $this->action = $action;
            return $this;
        }
            
        public function setParams(array $params) {
            $this->params = $params;
            return $this;
        }
        
        public function run() {
            call_user_func_array(array(new $this->controller, $this->action), $this->params);
        }
    }

    // Run the engine!
    $frontController = new DAMVP();
    $frontController->run();
?>