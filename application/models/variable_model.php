<?php

class Variable_model  extends CI_Model {
    
    protected $_name = 'ac_variables';
    const TIPO_ENTERO = 1;
    const TIPO_REAL = 2;
    const TIPO_BINARIO = 3;
    const TIPO_CADENA = 4;
    const TIPO_LISTA = 5;


    public function __construct()
    {
        parent::__construct();
    }
    

}