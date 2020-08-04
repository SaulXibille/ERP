<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nominas_modelo extends CI_Model {

  public function __construct() {
		parent::__construct();
	}

	public function obtenerNominas(){

    $this->db->select('e.nombres, e.apellidoP, e.apellidoM, nomi.sueldo, nomi.fecha, nomi.status, nomi.idNominas');
    $this->db->from('nominas nomi');
	$this->db->join('empleados e', 'nomi.idEmpleados = e.idEmpleados');
	$this->db->where('nomi.status', 1);

    $res = $this->db->get();

    if($res->num_rows() > 0) {
      $r = $res->row();
      return $res->result();
    }else {
      return 0;
    }
  }
  
  public function agregarNomina($data) {
    return $this->db->insert('nominas', $data);
  }

  public function eliminarNomina($idNomina) {
    $this->db->where('idNominas', $idNomina);
		$this->db->set('status', 0);
		$this->db->update('nominas');
		return ($this->db->affected_rows() > 0);
  }

  public function modificarNomina($idNomina) {
    $this->db->select("*");
    $this->db->from('nominas');
    $this->db->where('idNominas', $idNomina);
    $res = $this->db->get();
    if(count($res->result()) > 0) {
      return $res->row();
    }
  }

  public function actualizarNomina($data) {
    return $this->db->update('nominas', $data, array('idNominas' => $data['idNominas']));
  }

  public function detalleNomina($idNomina) {
    $this->db->select("*");
    $this->db->from('nominas');
    $this->db->where('idNominas', $idNomina);
    $res = $this->db->get();
    if(count($res->result()) > 0) {
      return $res->row();
    }
  }
}
