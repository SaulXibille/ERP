<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Colaboradores_modelo extends CI_Model {

  public function __construct() {
		parent::__construct();
	}

	public function obtenerEmpleados(){

    $this->db->select('e.nombres, e.apellidoP, e.apellidoM, p.nombrePuesto, e.estado');
    $this->db->from('empleados e');
    $this->db->join('puestos p', 'e.idPuesto = p.idPuesto');

    $res = $this->db->get();

    if($res->num_rows() > 0) {
      $r = $res->row();
      return 1;
    }else {
      return 0;
    }
	}
}
