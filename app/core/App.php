<?php

class App
{
    protected $controller = 'Siswa';
    protected $method;
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseURL();

        // Controller
        if (isset($url[0]) && file_exists('app/controllers/' . $url[0] . '.php')) {
            $this->controller = ucfirst($url[0]);
            unset($url[0]);
        }

        require_once 'app/controllers/' . $this->controller . '.php';

        $db = isset($GLOBALS['db']) ? $GLOBALS['db'] : null;
        $this->controller = new $this->controller($db);

        // Parameter
        $this->params = $url ? array_values($url) : [];

        // Auth/Login special case (pakai URL method langsung)
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($this->params[0]); // remove method from params
            $this->params = array_values($this->params);
        } else {
            // Default RESTful method selection
            $httpMethod = $_SERVER['REQUEST_METHOD'];
            switch ($httpMethod) {
                case 'GET':
                    $this->method = isset($this->params[0]) ? 'show' : 'index';
                    break;
                case 'POST':
                    $this->method = 'store';
                    break;
                case 'PUT':
                    $this->method = 'update';
                    break;
                case 'DELETE':
                    $this->method = 'destroy';
                    break;
                default:
                    $this->method = 'index';
            }
        }

        // Jalankan controller & method
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
        return [];
    }
}
