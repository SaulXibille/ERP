<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedores_modelo extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function obtenerProveedores(){

        $this->db->select('proveedores.razonSocial, proveedores.rfc, proveedores.giro');
        $this->db->from('proveedores proveedores');

        $res = $this->db->get();

        if($res->num_rows() > 0) {
            $r = $res->row();
            return 1;
        }else{
            return 0;
        }
    }
}