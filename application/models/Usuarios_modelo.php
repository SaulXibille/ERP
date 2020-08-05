<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_modelo extends CI_Model {

  public function __construct() {
		parent::__construct();
	}

	public function obtenerUsuarios(){
    $this->db->select('e.nombres, e.apellidoP, e.apellidoM, u.idUsuarios, u.status, u.correo');
    $this->db->from('empleados e');
    $this->db->join('usuarios u', 'e.idEmpleados = u.idEmpleados');
    $res = $this->db->get();

    if($res->num_rows() > 0) {
      $r = $res->row();
      return $res->result();
    }else {
      return 0;
    }
  }

  public function filtrarUsuarios($status) {
    $this->db->select('e.nombres, e.apellidoP, e.apellidoM, u.idUsuarios, u.status, u.correo');
    $this->db->from('empleados e');
    $this->db->join('usuarios u', 'e.idEmpleados = u.idEmpleados');
    $this->db->where('u.status', $status);

    $res = $this->db->get();

    if($res->num_rows() > 0) {
      $r = $res->row();
      return $res->result();
    }else {
      return 0;
    }
  }
  
  public function agregarUsuario($data) {
    return $this->db->insert('usuarios', $data);
  }

  public function cambiarStatus($idUsuario, $status) {
    if($status == "desactivar") {
      $status = 0;
    } else {
      $status = 1;
    }
    $this->db->where('idUsuarios', $idUsuario);
		$this->db->set('status', $status);
		$this->db->update('usuarios');
		return ($this->db->affected_rows() > 0);
  }

  public function modificarUsuario($idUsuario) {
    $this->db->select("*");
    $this->db->from('usuarios');
    $this->db->where('idUsuarios', $idUsuario);
    $res = $this->db->get();
    if(count($res->result()) > 0) {
      return $res->row();
    }
  }

  public function actualizarUsuario($data) {
    return $this->db->update('usuarios', $data, array('idUsuarios' => $data['idUsuarios']));
  }

  public function detalleUsuario($idUsuario) {
    $this->db->select("*");
    $this->db->from('usuarios');
    $this->db->where('idUsuarios', $idUsuario);
    $res = $this->db->get();
    if(count($res->result()) > 0) {
      return $res->row();
    }
  }
}
