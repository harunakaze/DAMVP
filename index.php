<?php
    // -- ######################## --
    // --         #     # #   #    --
    // --        #     # #  #      --
    // --       ####### # #        --
    // --      ####### # #         --
    // --     #     # #  #         --
    // --    #     # #   #         --
    // -- ######################## --
    require_once('config/include.php');
    class DAMVP {
        const DEFAULT_CONTROLLER = "index";
        const DEFAULT_ACTION = "index";

        protected $controller;
        protected $action        = self::DEFAULT_ACTION;
        protected $params        = array();
        protected $basePath      = "damvp/index.php";

        public function __construct() {
            // AUTOLOAD THEM ALL
            spl_autoload_register(function ($file) {
                if(file_exists('controller/' . $file . '.php')) {
                    include 'controller/' . $file . '.php';
                } elseif (file_exists('model/' . $file . '.php')) {
                    include 'model/' . $file . '.php';
                } else {
                    die("Classes not found! : " . $file);
                }
            });

            $this->parseUri();
        }

        protected function parseUri() {
            $path = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");

            $path = preg_replace('/[^a-zA-Z0-9]\//', "", $path);

            if (strpos($path, $this->basePath) === 0) {
                $path = substr($path, strlen($this->basePath));
            }

            // Trim request, especially preceding "/"
            $path = trim($path, "/");

            @list($controller, $action, $params) = explode("/", $path, 3);

            if (isset($controller) && !empty($controller)) {
                $this->setController($controller);
            } else {
                // require_once bug, setController must be called.
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
            //require_once('controller/' . $controller . '.php');

            $controller = ucfirst($controller) . 'Controller';
            if (!class_exists($controller)) {
                throw new InvalidArgumentException(
                    "The action controller '$controller' has not been defined.");
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