<?php

class Usuario_model  extends CI_Model {
    
    protected $_name = 'ac_usuarios';
    const ACTIVO = 1;
    const INACTIVO = 0;
    const ES_SUPER_USUARIO_TRUE = 1;
    const ES_SUPER_USUARIO_FALSE = 0;

    private $_es_super_usuario = 1;

    public function __construct()
    {
        parent::__construct();
    }
    
    public function auth($login, $pswd, $type = false)
    {   
        $dataUsuario = $this->_getUsuario($login, $pswd); 
        return $dataUsuario;
    }
    
    /**
     * Obtener datos de superUsuario
     */
    private function _getUsuario($login, $pswd)
    {
        $this->load->database();
        $sql = $this->db->query('
        SELECT 
        id_usuario,
        email,
        pswd,
        nombre,
        apellido,
        es_super_usuario,
        fecha_registro
        FROM '. $this->_name .'
        WHERE email = "' . $login . '" AND pswd = "' . $pswd . '" LIMIT 1'               
        );
        
        return $sql->row_array();
    }
    
    //--------------------------------------------------------------------------
    //--------------------------- USUARIO --------------------------------------

    /**
     * Proceso para listar Cuadros estadisticos para un Usuario
     * @param Array $dataGrid data objetivo, idusuario
     * @return mix string or Array.
     */
    public function jqListar(array $dataGrid)
    {
        $rs = false;
        $id_objetivo = $dataGrid['id_objetivo'];
        $id_usuario = $dataGrid['id_usuario'];
        
        $keyCache ="listaCuadros_" . $id_objetivo . "_" . $id_usuario;
        
        if (($rs = $this->cache->file->get($keyCache)) == false ) {
            // 01 lista de cuadros por id_objetivo
            $cuadros = $this->_listarCuadros($id_objetivo);        

            // 02 lista de usuarios id_usuario
            $usuarios = $this->_listarUsuarios();

            // 03 usuarios con cuadros (1 usuario 1 Cuadro relacion 1:1) BUG SI CAMBIA LOGICA
            // id_cuadro a eliminar
            $usuarioCuadro = array();        
            foreach ($usuarios as $key => $value) {
                if ($id_usuario != $value['id_usuario']) {
                    $usuarioCuadro[] = $this->_listarUsuariosConCuadro($id_objetivo, $value['id_usuario']);
                }
            }
            $idCuadroPropietario = $this->_getIdCuadros($usuarioCuadro);
            
            // 04 lista de cuadros a no eliminar
            $usuarioCuadroAsignado = array();
            $usuarioCuadroAsignado[] = $this->_listarUsuariosConCuadro($id_objetivo, $id_usuario, true);
            $idCuadroPropietarioAsignado = $this->_getIdCuadros($usuarioCuadroAsignado);
            
            $idCuadroPropietario = array_diff($idCuadroPropietario, $idCuadroPropietarioAsignado);
            $rs = $this->_eliminarCuadros($cuadros, $idCuadroPropietario);
            $this->cache->file->save($keyCache, $rs, 600);            
        }
        return $rs;
    }
    
    
    //--------------------------------------------------------------------------
    //--------------------------- USUARIO  HELP --------------------------------    
    /**
     * Listar cuadros ayuda
     * @return Array
     */
    private function _listarCuadros($id_objetivo)
    {
        $this->db->select('id_cuadro, titulo, fecha_registro');
        $this->db->where('id_objetivo', $id_objetivo);
        $this->db->from('ac_cuadros');
        $query = $this->db->get();
        return $query->result_array();        
    }
    
    /**
     * Listar ayuda
     * @return Array
     */    
    private function _listarUsuarios()
    {
        return $this->db->select('id_usuario')
        ->where('es_super_usuario', self::ES_SUPER_USUARIO_FALSE)
        ->get('ac_usuarios')
        ->result_array();        
    }

/**
 * 
 * @param type $id_objetivo 
 * @param type $id_usuario
 * @param type $usuarioAsignado Estado para filtrar datos.
 * @return type Array
 */
    private function _listarUsuariosConCuadro($id_objetivo, $id_usuario, $usuarioAsignado = false)
    {
        $this->db->select('ac_cuadros.id_cuadro')->from('ac_cuadros');
        $this->db->join('ac_cuadros_usuarios', 'ac_cuadros.id_cuadro = ac_cuadros_usuarios.id_cuadro');
        $this->db->where('ac_cuadros.id_objetivo', $id_objetivo);
        if ($usuarioAsignado == true) { 
           $this->db->where('ac_cuadros_usuarios.usuario_asignado', $id_usuario); 
        } else {
            $this->db->where('ac_cuadros_usuarios.id_usuario', $id_usuario);
        }
        $this->db->group_by('ac_cuadros.id_cuadro');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    /**
     * Ordena en un array simple los ids de Cuadros Estadisticos.
     * @param array $arrayDesordenado
     * @return type
     */
    private function _getIdCuadros(array $arrayDesordenado)
    {
        $colecionIdCuadro = array();
        $i = 0;
        foreach ($arrayDesordenado as $arreglo => $value) {
            foreach ($value as $llave => $valor) {
                $colecionIdCuadro[$i] = $valor['id_cuadro'];
                $i++;
            }
        }
        return $colecionIdCuadro;
    }
    
    /**
     * Bucle para eliminar cuadros 
     * @param array $cuadros data de cuadros
     * @param array $idCuadros ids a eliminar
     */
    private function _eliminarCuadros(array $cuadros, array $idCuadros)
    {
        for ($i = 0; count($cuadros) > $i; $i++) {
            foreach ($idCuadros as $llave => $valor) {
                if ($cuadros[$i]['id_cuadro'] == $valor) {              
                    unset($cuadros[$i]);
                    $cuadros = array_values($cuadros);
                    $i = 0;
                    break;
                }                
            }
        }
        return $cuadros;        
    }
}
