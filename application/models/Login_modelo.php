<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_modelo extends CI_Model {

  public function __construct() {
		parent::__construct();
	}

	public function ingresar($correo, $contraseña){

    $this->db->select('e.nombres, e.apellidoP, e.apellidoM, p.nombrePuesto, u.idUsuario');
    $this->db->from('empleados e');
    $this->db->join('puestos p', 'e.idPuesto = p.idPuesto');
    $this->db->join('usuarios u', 'e.idEmpleado = u.idEmpleado');
    $this->db->where('u.correo', $correo);
    $this->db->where('u.contraseña', $contraseña);
    $this->db->where('u.estado', 1);

    $res = $this->db->get();

    if($res->num_rows() > 0) {
      $r = $res->row();

      $s_usuario = array(
        's_idUsuario' => $r->idUsuario,
        's_usuario' => $r->nombres.", ".$r->apellidoP.", ".$r->apellidoM
      );

      $this->session->set_userdata($s_usuario);

      return 1;
    }else {
      return 0;
    }
	}
}
