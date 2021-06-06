<?php

class Pemesanan_model extends CI_Model
{
    private $_table = "pemesanan";

    public function create($data){
        try {
            $this->db->insert($this->_table,$data);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function update($data,$id){
        try {
            $this->db->where('resi', $id);
            $this->db->update($this->_table, $data);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function detail($key){
        try {
            $this->db->select("list_menu.*,pemesanan.*, u.*");
            $this->db->from($this->_table);
            $this->db->join('list_menu', 'list_menu.id = pemesanan.menu_id');
            $this->db->join('users u', 'u.user_id = pemesanan.user_id', 'left');
            $this->db->where("pemesanan.resi", $key);
            return $this->db->get();
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function listdata(){
        try {
            $this->db->select("DISTINCT(p.resi),p.status,p.metode,u.username,p.resi");
            $this->db->from("$this->_table p");
            $this->db->join('users u', 'u.user_id = p.user_id', 'left');
            $this->db->join('list_menu lm', 'lm.id = p.menu_id', 'left');
            return $this->db->get();
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function listdataby($key,$key2){
        try {
            $array = array('p.created_at >=' => $key,'p.created_at <=' => $key2);

            $this->db->select("DISTINCT(lm.nama),p.created_at,p.qty,p.total");
            $this->db->select_sum('p.qty');
            $this->db->from("$this->_table p");
            $this->db->join('users u', 'u.user_id = p.user_id', 'left');
            $this->db->join('list_menu lm', 'lm.id = p.menu_id', 'left');
            $this->db->group_by('lm.nama,p.created_at,p.qty,p.total');
            $this->db->where($array);
            return $this->db->get();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function cek($key){
        try {
            $this->db->select("*");
            $this->db->from("$this->_table");
            $this->db->where("pemesanan.resi", $key);
            $this->db->limit(1); 
            return $this->db->get();
        } catch (\Throwable $th) {
            return [];
        }
    }
}
?>