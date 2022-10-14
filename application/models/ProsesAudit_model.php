<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ProsesAudit_model extends CI_Model
{
    public function get($where = false) {
        if($where) $this->db->where($where);
        $query = $this->db->get('proses_audit');
        return $query->result();
    }

    public function get_where($where) {
        $this->db->where($where);
        $query = $this->db->get('proses_audit');
        return $query->row();
    }

    public function insert($data) {
        $this->db->set($data);
        $this->db->insert('proses_audit');
        return $this->db->insert_id();
    }

    public function update($data, $where) {
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('proses_audit');
    }

    public function delete($where) {
        $this->db->where($where);
        return $this->db->delete('proses_audit');
    }
}