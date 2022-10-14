<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_model extends CI_Model
{
    public function get($where = false, $table = 'jadwal') {
        if($where) $this->db->where($where);
        $query = $this->db->get($table);
        return $query->result();
    }

    public function get_where($where, $table = 'jadwal') {
        $this->db->where($where);
        $query = $this->db->get($table);
        return $query->row();
    }

    public function insert($data, $table = 'jadwal') {
        $this->db->set($data);
        $this->db->insert($table);
        return $this->db->insert_id();
    }

    public function update($data, $where, $table = 'jadwal') {
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update($table);
    }

    public function delete($where, $table = 'jadwal') {
        $this->db->where($where);
        return $this->db->delete($table);
    }
}