<?php
class App
{
    protected $controller = 'Home';
    protected $method = 'index';
    protected $parameter = [];
    public function __construct()
    {
        $url = $this->parseURL();
        if (isset($url[0]) && file_exists('../app/controllers/' . $url[0] . '.php')) {
            //jika url[0] ada dan url[0] pada direktori controllers ada,jadikan url[0] sebagai controller
            $this->controller = $url[0];
            unset($url[0]); //hapus url[0] agar elemen berikutnya bisa digunakan untuk method
        }
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            //jika url[1] ada, cari url[1] pada controller yg dipanggil lalu jadikan sebagai method
            $this->method = $url[1];
            unset($url[1]); //hapus url[1] agar elemen berikutnya bisa digunakan untuk parameter
        }

        if (!empty($url)) {
            //jika url tidak kosong maka jadikan url sebagai parameter
            $this->parameter = array_values($url);
        }

        call_user_func_array([$this->controller, $this->method], $this->parameter); //memanggil method dari controller yang ditentukan dengan parameter yang ada
    }
    public function parseURL()
    {
        if (isset($_GET['url'])) {
            //jika ada url yg dikirimkan,ambil url nya
            $url = rtrim($_GET['url'], '/'); //rtrim membersihkan slas diakhir
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url); //memecah string URL menjadi array berdasarkan pemisah slas
            return $url;
        }
    }
}
