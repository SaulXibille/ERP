<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Puestos_modelo extends CI_Model {

  public function __construct() {
		parent::__construct();
	}

	public function obtenerPuestos(){

    $this->db->select('*');
    $this->db->from('puestos');
    $res = $this->db->get();

    if($res->num_rows() > 0) {
      $r = $res->row();
      return $res->result();
    }else {
      return 0;
    }
  }

  public function filtrarPuestos($status) {
    $this->db->select('*');
    $this->db->from('puestos');
    $this->db->where('status', $status);

    $res = $this->db->get();

    if($res->num_rows() > 0) {
      $r = $res->row();
      return $res->result();
    }else {
      return 0;
    }
  }

  public function obtenerPuestosActivos(){

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
  
  public function agregarPuesto($data) {
    return $this->db->insert('puestos', $data);
  }

  // public function eliminarPuesto($idPuesto) {
  //   $this->db->where('idPuestos', $idPuesto);
	// 	$this->db->set('status', 0);
	// 	$this->db->update('puestos');
	// 	return ($this->db->affected_rows() > 0);
  // }

  public function cambiarStatus($idPuesto, $status) {
    if($status == "desactivar") {
      $status = 0;
    } else {
      $status = 1;
    }
    $this->db->where('idPuestos', $idPuesto);
		$this->db->set('status', $status);
		$this->db->update('puestos');
		return ($this->db->affected_rows() > 0);
  }

  public function modificarPuesto($idPuesto) {
    $this->db->select("*");
    $this->db->from('puestos');
    $this->db->where('idPuestos', $idPuesto);
    $res = $this->db->get();
    if(count($res->result()) > 0) {
      return $res->row();
    }
  }

  public function actualizarPuesto($data) {
    return $this->db->update('puestos', $data, array('idPuestos' => $data['idPuestos']));
  }

  public function detallePuesto($idPuesto) {
    $this->db->select("*");
    $this->db->from('puestos');
    $this->db->where('idPuestos', $idPuesto);
    $res = $this->db->get();
    if(count($res->result()) > 0) {
      return $res->row();
    }
  }
}
