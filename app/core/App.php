<?php
class App
{
    public function __construct()
    {
        $url = $this->parseURL();
        var_dump($url);
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
