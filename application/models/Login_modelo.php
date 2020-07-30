<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_modelo extends CI_Model {

  public function __construct() {
		parent::__construct();
	}

	public function ingresar($correo, $contraseña){

    $this->db->select('e.nombres, e.apellidoP, e.apellidoM, p.nombrePuesto, u.idUsuarios, e.idEmpleados, u.status');
    $this->db->from('empleados e');
    $this->db->join('puestos p', 'e.idPuestos = p.idPuestos');
    $this->db->join('usuarios u', 'e.idEmpleados = u.idEmpleados');
    $this->db->where('u.correo', $correo);
    $this->db->where('u.contraseña', $contraseña);
    $this->db->where('u.status', 1);

    $res = $this->db->get();

    if($res->num_rows() > 0) {
      return $res->row();
    }
    else{
      return false;
    }
  }
}