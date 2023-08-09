<?php

namespace app\core;


class Request
{
    private array $routeParams = [];

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function getUrl()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');

        if ($position !== false) {
            $path = substr($path, 0, $position);
        }

        if ($path != '/' && substr($path, -1) === '/') {
            $path = rtrim($path, '/');
            header("Location:  $path");
            exit();
        }

        return $path;
    }


    public function isGet()
    {
        return $this->getMethod() === 'get';
    }

    public function isPost()
    {
        return $this->getMethod() === 'post';
    }

    public function getBody()
    {
        $data = [];
        if ($this->isGet()) {
            foreach ($_GET as $key => $value) {
                $data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->isPost()) {
            if (empty($_POST)) {
                $data = json_decode(file_get_contents('php://input'), true);
            } else {
                foreach ($_POST as $key => $value) {
                    if (is_array($value)) {
                        $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }
        return $data;
    }

    public function get_files()
    {
        $fileData = $_FILES['file'];
        $fileCount = count($fileData['name']);
        if ($fileData['name'][0] == '') {
            return false;
        }
        $files = [];

        for ($i = 0; $i < $fileCount; $i++) {
            $file = [
                'name' => $fileData['name'][$i],
                'full_path' => $fileData['full_path'][$i],
                'type' => $fileData['type'][$i],
                'tmp_name' => $fileData['tmp_name'][$i],
                'error' => $fileData['error'][$i],
                'size' => $fileData['size'][$i]
            ];

            $files[] = $file;
        }

        return $files;
    }

    public function setRouteParams($params)
    {
        $this->routeParams = $params;
        return $this;
    }

    public function getRouteParams()
    {
        return $this->routeParams;
    }

    public function getRouteParam($param, $default = null)
    {
        return $this->routeParams[$param] ?? $default;
    }
}
