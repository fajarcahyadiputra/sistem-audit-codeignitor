
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Document_audit extends CI_Model
{
    public function get($where = false, $table = 'document_audit') {
        if($where) $this->db->where($where);
        $query = $this->db->get($table);
        return $query->result();
    }

    public function get_where($where, $table = 'document_audit') {
        $this->db->where($where);
        $query = $this->db->get($table);
        return $query->row();
    }

    public function insert($data, $table = 'document_audit') {
        $this->db->set($data);
        $this->db->insert($table);
        return $this->db->insert_id();
    }

    public function update($data, $where, $table = 'document_audit') {
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update($table);
    }

    public function delete($where, $table = 'document_audit') {
        $this->db->where($where);
        return $this->db->delete($table);
    }
}