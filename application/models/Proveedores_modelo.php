<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedores_modelo extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function obtenerProveedores(){

        $this->db->select('prov.razonSocial, prov.rfc, prov.giro, prov.idProveedores, prov.status');
        $this->db->from('proveedores prov');

        $res = $this->db->get();

        if($res->num_rows() > 0) {
            $r = $res->row();
            return $res->result();
        }else{
            return 0;
        }
    }

    public function obtenerProveedoresActivos(){

        $this->db->select('prov.razonSocial, prov.rfc, prov.giro, prov.idProveedores, prov.status');
        $this->db->from('proveedores prov');
        $this->db->where('prov.status', 1);
    
        $res = $this->db->get();
    
        if($res->num_rows() > 0) {
          $r = $res->row();
          return $res->result();
        }else {
          return 0;
        }
      }

      public function filtrarProveedores($status) {
        $this->db->select('prov.razonSocial, prov.rfc, prov.giro, prov.idProveedores, prov.status');
        $this->db->from('proveedores prov');
        $this->db->where('prov.status', $status);
    
        $res = $this->db->get();
    
        if($res->num_rows() > 0) {
          $r = $res->row();
          return $res->result();
        }else {
          return 0;
        }
      }

    public function agregarProveedor($data) {
        return $this->db->insert('proveedores', $data);
      }

      public function cambiarStatus($idProveedor,$status) {
        if($status == "desactivar") {
          $status = 0;
        } else {
          $status = 1;
        }
        $this->db->where('idProveedores', $idProveedor);
        $this->db->set('status', $status);
        $this->db->update('proveedores');
        return ($this->db->affected_rows() > 0);
      }

      public function eliminarProveedor($idProveedor) {
        $this->db->where('idProveedores', $idProveedor);
            $this->db->set('status', 0);
            $this->db->update('proveedores');
            return ($this->db->affected_rows() > 0);
      }
    
      public function modificarProveedor($idProveedor) {
        $this->db->select("*");
        $this->db->from('proveedores');
        $this->db->where('idProveedores', $idProveedor);
        $res = $this->db->get();
        if(count($res->result()) > 0) {
          return $res->row();
        }
    }

    public function actualizarProveedor($data) {
        return $this->db->update('proveedores', $data, array('idProveedores' => $data['idProveedores']));
    }
    
    public function detalleProveedor($idProveedor) {
        $this->db->select("*");
        $this->db->from('proveedores');
        $this->db->where('idProveedores', $idProveedor);
        $res = $this->db->get();
        if(count($res->result()) > 0) {
          return $res->row();
        }
    }

}