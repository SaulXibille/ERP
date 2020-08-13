<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas_modelo extends CI_Model {

  public function __construct() {
		parent::__construct();
	}

	public function obtenerVentas(){
    $this->db->select('v.idVentas, v.fecha, v.subtotal, v.status, v.idEmpleados, e.nombres, e.apellidoP, e.apellidoM');
    $this->db->from('ventas v');
    $this->db->join('empleados e', 'v.idEmpleados = e.idEmpleados');
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

  public function filtrarVentas($status) {
    $this->db->select('v.idVentas, v.fecha, v.subtotal, v.status, v.idEmpleados, e.nombres, e.apellidoP, e.apellidoM');
    $this->db->from('ventas v');
    $this->db->join('empleados e', 'v.idEmpleados = e.idEmpleados');
    $this->db->where('v.status', $status);

    $res = $this->db->get();

    if($res->num_rows() > 0) {
      $r = $res->row();
      return $res->result();
    }else {
      return 0;
    }
  }

  public function filtrarVentasMes() {
    $this->db->select('v.idVentas, v.fecha, v.subtotal, v.status, v.idEmpleados, e.nombres, e.apellidoP, e.apellidoM');
    $this->db->from('ventas v');
    $this->db->join('empleados e', 'v.idEmpleados = e.idEmpleados');
    $this->db->order_by('MONTH(v.fecha)');
    $res = $this->db->get();

    if($res->num_rows() > 0) {
      $r = $res->row();
      return $res->result();
    }else {
      return 0;
    }
  }
  
  public function agregarVenta($data) {
    $this->db->insert('ventas', $data);
    
    $this->db->select("MAX(idVentas) as idVenta");
    $this->db->from('ventas');
    $res = $this->db->get();
    if(count($res->result()) > 0) {
      return $res->row();
    }
  }

  public function agregarDetalleVentas($data) {
    return $this->db->insert('detalleVentas', $data);
  }

  public function cambiarStatus($idVenta, $status) {
    if($status == "desactivar") {
      $status = 0;
    } else {
      $status = 1;
    }
    $this->db->where('idVentas', $idVenta);
		$this->db->set('status', $status);
    $this->db->update('ventas');
    
    $this->db->select("*");
    $this->db->from('ventas v');
    $this->db->join('detalleventas dv', 'v.idVentas = dv.idVentas');
    $this->db->where('v.idVentas', $idVenta);

		$res = $this->db->get();
    return $res->result();
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

  public function detalleVenta($idVenta) {
    $this->db->select("dv.idVentas, dv.idProductos, dv.cantidad, v.fecha, 
    v.subtotal, v.clienteNombre, v.clienteApellidoP, v.clienteApellidoM, 
    v.clienteContacto, p.nombreProducto, p.precioPublico, p.marca, p.numSerie");
    $this->db->from('detalleventas dv');
    $this->db->join('ventas v', 'dv.idVentas = v.idVentas');
    $this->db->join('productos p', 'dv.idProductos = p.idProductos');
    $this->db->where('dv.idVentas', $idVenta);
    $res = $this->db->get();
    if($res->num_rows() > 0) {
      $r = $res->row();
      return $res->result();
    }else {
      return 0;
    }
  }

}
