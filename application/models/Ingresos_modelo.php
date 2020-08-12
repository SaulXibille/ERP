<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ingresos_modelo extends CI_Model {

  public function __construct() {
		parent::__construct();
	}

	public function obtenerIngresos(){
        $this->db->select_sum('v.subtotal');
        $this->db->select('DATE(fecha) as fecha, v.idVentas');
        $this->db->from('ventas v');
        $this->db->group_by('DAY(fecha)');

        $res = $this->db->get();

        if($res->num_rows() > 0) {
        $r = $res->row();
        return $res->result();
        }else {
        return 0;
        }
    }   

    public function filtrarIngresos() {
        $this->db->select_sum('v.subtotal');
        $this->db->select('DATE_FORMAT(fecha,"%Y-%m") AS fecha, v.idVentas');
        $this->db->from('ventas v');
        $this->db->group_by('MONTH(fecha)');

        $res = $this->db->get();

        if($res->num_rows() > 0) {
        $r = $res->row();
        return $res->result();
        }else {
        return 0;
        }
    }

    public function detalleIngresos($fecha) {
        $this->db->select_sum('v.subtotal');
        $this->db->select('DATE(fecha) as fecha, count(d.idVentas) as num');
        $this->db->from('ventas v');
        $this->db->join('detalleventas d', 'v.idVentas = d.idVentas');
        $this->db->where('DATE(fecha)',$fecha);
        $this->db->group_by('DAY(fecha)');

        $res = $this->db->get();

        if($res->num_rows() > 0) {
        $r = $res->row();
        return $res->result();
        }else {
        return 0;
        }
    }

    public function detalleIngresos2($fecha) {
        $this->db->select_sum('v.subtotal');
        $this->db->select('DATE_FORMAT(fecha,"%Y-%m") AS fecha, count(d.idVentas) as num');
        $this->db->from('ventas v');
        $this->db->join('detalleventas d', 'v.idVentas = d.idVentas');
        $this->db->where('DATE_FORMAT(fecha,"%Y-%m")',$fecha);
        $this->db->group_by('MONTH(fecha)');

        $res = $this->db->get();

        if($res->num_rows() > 0) {
        $r = $res->row();
        return $res->result();
        }else {
        return 0;
        }
    }

    public function ingresos_egresos() {
        $this->db->select('SUM(subtotal) AS total');
        $this->db->from('ventas');
        $query1 = $this->db->get_compiled_select();

        $this->db->select('SUM(subtotal) AS total');
        $this->db->from('egresos');
        $query2 = $this->db->get_compiled_select();       

        $res = $this->db->query($query1 . ' UNION ALL ' . $query2);

        if($res->num_rows() > 0) {
            $r = $res->row();
            return $res->result();
        }else {
            return 0;
        }
    }
  
}
