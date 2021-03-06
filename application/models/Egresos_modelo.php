<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Egresos_modelo extends CI_Model {

  public function __construct() {
		parent::__construct();
	}

	public function obtenerEgresos(){
        $this->db->select('e.id_Egresos, e.serie, e.folio, e.subtotal, e.fecha, e.idProveedores, e.status, p.idProveedores, p.razonSocial');
        $this->db->from('egresos e');
        $this->db->join('proveedores p', 'e.idProveedores = p.idProveedores');

        $res = $this->db->get();

        if($res->num_rows() > 0) {
        $r = $res->row();
        return $res->result();
        }else {
        return 0;
        }
    }   

    public function agregarEgreso($data) {
        return $this->db->insert('egresos', $data);
    }

    public function detalleEgresos($id_Egresos) {
        $this->db->select("*");
        $this->db->from('egresos');
        $this->db->where('id_Egresos', $id_Egresos);
        $res = $this->db->get();
        if(count($res->result()) > 0) {
          return $res->row();
        }
    }

    public function actualizarEgreso($data) {
        return $this->db->update('egresos', $data, array('id_Egresos' => $data['id_Egresos']));
      }

      public function filtrarEgresos($status) {
        $this->db->select('e.id_Egresos, e.serie, e.folio, e.subtotal, e.fecha, e.idProveedores, e.status, p.idProveedores, p.razonSocial');
        $this->db->from('egresos e');
        $this->db->join('proveedores p', 'e.idProveedores = p.idProveedores');
        $this->db->where('e.status', $status);
    
        $res = $this->db->get();
    
        if($res->num_rows() > 0) {
          $r = $res->row();
          return $res->result();
        }else {
          return 0;
        }
      }

      public function cambiarStatus($id_Egresos, $status) {
        if($status == "desactivar") {
          $status = 0;
        } else {
          $status = 1;
        }
        $this->db->where('id_Egresos', $id_Egresos);
        $this->db->set('status', $status);
        $this->db->update('egresos');
        return ($this->db->affected_rows() > 0);
      }
    
  
}
