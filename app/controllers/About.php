<?php
class About extends Controller
{
    public function index($nama = '...', $umur = '...')
    {
        $data = [
            'tittle' => 'about',
            'nama' => $nama,
            'umur' => $umur,
        ];
        $this->view('/templates/header', $data);
        $this->view('/about/index', $data);
        $this->view('/templates/footer');
    }
    public function page()
    {
        $data = [
            'tittle' => 'about'
        ];
        $this->view('/templates/header', $data);
        $this->view('/about/page');
        $this->view('/templates/footer');
    }
}
