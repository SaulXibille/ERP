<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos_modelo extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function obtenerProductos(){

        $this->db->select('produc.nombreProducto, produc.marca, produc.costo, produc.precioPublico, produc.sku, produc.status, produc.numSerie, produc.modelo, produc.tipo, prov.razonSocial, produc.idProductos');
        $this->db->from('productos produc');
        $this->db->join('proveedores prov', 'produc.idProveedores = prov.idProveedores');
        $this->db->where('produc.status', 1);

        $res = $this->db->get();

        if($res->num_rows() > 0) {
            $r = $res->row();
            return $res->result();
        }else{
            return 0;
        }
    }

    public function agregarProducto($data) {
        return $this->db->insert('productos', $data);
      }
    
      public function eliminarProducto($idProducto) {
        $this->db->where('idProductos', $idProducto);
            $this->db->set('status', 0);
            $this->db->update('productos');
            return ($this->db->affected_rows() > 0);
      }
    
      public function modificarProducto($idProducto) {
        $this->db->select("*");
        $this->db->from('productos');
        $this->db->where('idProductos', $idProducto);
        $res = $this->db->get();
        if(count($res->result()) > 0) {
          return $res->row();
        }
      }
    
      public function actualizarProducto($data) {
        return $this->db->update('productos', $data, array('idProductos' => $data['idProductos']));
      }
    
      public function detalleProducto($idProducto) {
        $this->db->select("*");
        $this->db->from('productos');
        $this->db->where('idProductos', $idProducto);
        $res = $this->db->get();
        if(count($res->result()) > 0) {
          return $res->row();
        }
      }
}