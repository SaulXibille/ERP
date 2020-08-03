<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Puestos_modelo extends CI_Model {

  public function __construct() {
		parent::__construct();
	}

	public function obtenerPuestos(){

    $this->db->select('*');
    $this->db->from('puestos');
    $this->db->where('status', 1);

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

  public function eliminarUsuario($idUsuario) {
    $this->db->where('idUsuarios', $idUsuario);
		$this->db->set('status', 0);
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
