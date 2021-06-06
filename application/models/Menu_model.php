<?php

class Menu_model extends CI_Model
{
    private $_table = "list_menu";

    public function index(){
        try {
            $query=$this->db->get($this->_table);
            return $query->result();
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function kategori(){
        try {
            // $query=$this->db->distinct()->select('kategori')->get($this->_table);;
            $query=$this->db->distinct()->select('kategori, COUNT(id) AS count', false)->from($this->_table)->group_by('kategori')->get();
            return $query->result();
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function create($data){
        try {
            $this->db->insert($this->_table,$data);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function delete($id){
        try {
            $this->db->where('id', $id);
            $this->db->delete($this->_table); 
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function search($key){
        try {
            $this->db->select("*");
            $this->db->from($this->_table);
            if($key != '')
            {
                $this->db->like('nama', $key);
            }
            $this->db->order_by('nama', 'DESC');
            return $this->db->get();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function searchkategori($key){
        try {
            $query = $this->db->distinct()->select('kategori, COUNT(id) AS count', false)->from($this->_table)->like('nama', $key)->group_by('kategori')->get();
            return $query;
        } catch (\Throwable $th) {
            return false;
        }
    }

}
?>