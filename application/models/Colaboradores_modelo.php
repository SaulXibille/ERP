<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Colaboradores_modelo extends CI_Model {

  public function __construct() {
		parent::__construct();
	}

	public function obtenerEmpleados(){

    $this->db->select('e.nombres, e.apellidoP, e.apellidoM, p.nombrePuesto, e.status, e.correo, e.idEmpleados');
    $this->db->from('empleados e');
    $this->db->join('puestos p', 'e.idPuestos = p.idPuestos');
    // $this->db->where('e.status', 1);

    $res = $this->db->get();

    if($res->num_rows() > 0) {
      $r = $res->row();
      return $res->result();
    }else {
      return 0;
    }
  }

  public function obtenerEmpleadosActivos(){

    $this->db->select('e.nombres, e.apellidoP, e.apellidoM, p.nombrePuesto, e.status, e.correo, e.idEmpleados');
    $this->db->from('empleados e');
    $this->db->join('puestos p', 'e.idPuestos = p.idPuestos');
    $this->db->where('e.status', 1);

    $res = $this->db->get();

    if($res->num_rows() > 0) {
      $r = $res->row();
      return $res->result();
    }else {
      return 0;
    }
  }

  public function filtrarEmpleados($status) {
    $this->db->select('e.nombres, e.apellidoP, e.apellidoM, p.nombrePuesto, e.status, e.correo, e.idEmpleados');
    $this->db->from('empleados e');
    $this->db->join('puestos p', 'e.idPuestos = p.idPuestos');
    $this->db->where('e.status', $status);

    $res = $this->db->get();

    if($res->num_rows() > 0) {
      $r = $res->row();
      return $res->result();
    }else {
      return 0;
    }
  }
  
  public function agregarEmpleado($data) {
    return $this->db->insert('empleados', $data);
  }

  public function cambiarStatus($idEmpleado, $status) {
    if($status == "desactivar") {
      $status = 0;
    } else {
      $status = 1;
    }
    $this->db->where('idEmpleados', $idEmpleado);
		$this->db->set('status', $status);
		$this->db->update('empleados');
		return ($this->db->affected_rows() > 0);
  }

  public function modificarEmpleado($idEmpleado) {
    $this->db->select("*");
    $this->db->from('empleados');
    $this->db->where('idEmpleados', $idEmpleado);
    $res = $this->db->get();
    if(count($res->result()) > 0) {
      return $res->row();
    }
  }

  public function actualizarEmpleado($data) {
    return $this->db->update('empleados', $data, array('idEmpleados' => $data['idEmpleados']));
  }

  public function detalleEmpleado($idEmpleado) {
    $this->db->select("*");
    $this->db->from('empleados');
    $this->db->where('idEmpleados', $idEmpleado);
    $res = $this->db->get();
    if(count($res->result()) > 0) {
      return $res->row();
    }
  }

}
