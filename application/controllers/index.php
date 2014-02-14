<?php

class Index extends MY_Controller {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $this->load->library('layout');        
        $data['titulo'] = "h1 index in home";        
        $this->layout->view('adm-home/index', $data);        
    }
}
