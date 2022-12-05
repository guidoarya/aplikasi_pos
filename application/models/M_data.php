<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_data extends CI_Model {

    public function save($table, $data)
    {
        $this->db->insert($table, $data);
    }

    public function update($table, $data, $condition)
    {
        $this->db->update($table, $data, $condition);
    }

    public function delete($table, $condition)
    {
        $this->db->delete($table, $condition);
    }

    public function get_all($table)
    {
        $this->db->select('*');
        $this->db->from($table);
        return $this->db->get()->result();
    }    

    public function get_condition($table, $condition)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($condition);
        return $this->db->get()->row_array();
    }

    public function get_2condition($table, $condition, $condition2)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($condition);
        $this->db->where($condition2);
        return $this->db->get()->row_array();
    }

    public function count($table)
    {
        return $this->db->query('SELECT * FROM '.$table)->num_rows();
    }

    public function get_2join($table, $join1, $condition1, $join2, $condition2, $id_tb1, $order)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join($join1, $condition1, 'left');
        $this->db->join($join2, $condition2, 'left');
        $this->db->order_by($id_tb1, $order);
        return $this->db->get()->result();
    }

    public function getCondition_2join($table, $condition, $join1, $condition1, $join2, $condition2)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join($join1, $condition1, 'left');
        $this->db->join($join2, $condition2, 'left');
        $this->db->where($condition);
        return $this->db->get()->row_array();
    }

    // public function get_allSel($select, $table)
    // {
    //     $this->db->select($select);
    //     $this->db->from($table);
    //     return $this->db->get()->result();
    // }

    // public function get_2joinDel($select, $table, $join1, $condition1, $join2, $condition2, $id_tb1, $order)
    // {
    //     $this->db->select($select);
    //     $this->db->from($table);
    //     $this->db->join($join1, $condition1, 'left');
    //     $this->db->join($join2, $condition2, 'left');
    //     $this->db->order_by($id_tb1, $order);
    //     return $this->db->get()->result();
    // }

}

?>