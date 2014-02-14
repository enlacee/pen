<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Adm_home
 *
 * @author anb
 */
class Adm_home extends MY_Controller {
    
    public function __construct() 
    {   
        parent::__construct();
    }
    
    public function index()
    {
        $this->load->view('adm-home/index');
    }
    
}
