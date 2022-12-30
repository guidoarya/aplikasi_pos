<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_data extends CI_Model
{


    // start datatables
    var $column_orderItem = array('id_item', 'barcode_item', 'p_item.name_item', 'name_category', 'name_unit', 'price', 'stock'); //set column field database for datatable orderable
    var $column_searchItem = array('barcode_item', 'p_item.name_item', 'price'); //set column field database for datatable searchable
    var $orderItem = array('id_item' => 'asc'); // default order

    private function _get_datatables_query($table, $join1, $condition1, $join2, $condition2)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join($join1, $condition1, 'left');
        $this->db->join($join2, $condition2, 'left');
        $i = 0;
        
        // item
        if ($table == 'p_item') {
            foreach ($this->column_searchItem as $item) { // loop column 
                if (@$_POST['search']['value']) { // if datatable send POST for search
                    if ($i === 0) { // first loop
                        $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                        $this->db->like($item, $_POST['search']['value']);
                    } else {
                        $this->db->or_like($item, $_POST['search']['value']);
                    }
                    if (count($this->column_searchItem) - 1 == $i) //last loop
                        $this->db->group_end(); //close bracket
                }
                $i++;
            }
        
            if (isset($_POST['order'])) { // here order processing
                $this->db->order_by($this->column_orderItem[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } else if (isset($this->orderItem)) {
                $order = $this->orderItem;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }
        
    }
    function get_datatables($table, $join1, $condition1, $join2, $condition2)
    {
        $this->_get_datatables_query($table, $join1, $condition1, $join2, $condition2);
        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered($table, $join1, $condition1, $join2, $condition2)
    {
        $this->_get_datatables_query($table, $join1, $condition1, $join2, $condition2);
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all($table)
    {
        $this->db->from($table);
        return $this->db->count_all_results();
    }
    // end datatables


    // my models custom !

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

    public function getResult_condition($table, $condition)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($condition);
        return $this->db->get()->result();
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
        return $this->db->query('SELECT * FROM ' . $table)->num_rows();
    }

    public function sum($select, $table, $condition)
    {
        $this->db->select_sum($select);
        $this->db->where($condition);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            return $query->row()->total;
        } else {
            return 0;
        }
    }

    public function getCondition_1join($table, $condition, $join1, $condition1)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join($join1, $condition1, 'left');
        $this->db->where($condition);
        return $this->db->get()->row_array();
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

    public function getResultCondition_2join($table, $condition, $join1, $condition1, $join2, $condition2)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join($join1, $condition1, 'left');
        $this->db->join($join2, $condition2, 'left');
        $this->db->where($condition);
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

    public function get_3join($table, $join1, $condition1, $join2, $condition2, $join3, $condition3, $id_tb1, $order)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join($join1, $condition1, 'left');
        $this->db->join($join2, $condition2, 'left');
        $this->db->join($join3, $condition3, 'left');
        $this->db->order_by($id_tb1, $order);
        return $this->db->get()->result();
    }

    public function getCondition_3join($table, $condition, $join1, $condition1, $join2, $condition2, $join3, $condition3)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join($join1, $condition1, 'left');
        $this->db->join($join2, $condition2, 'left');
        $this->db->join($join3, $condition3, 'left');
        $this->db->where($condition);
        return $this->db->get()->result();
    }

    public function getConditionRow_3join($table, $condition, $join1, $condition1, $join2, $condition2, $join3, $condition3)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join($join1, $condition1, 'left');
        $this->db->join($join2, $condition2, 'left');
        $this->db->join($join3, $condition3, 'left');
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

    public function invoice_sale()
    {
        $sql = "SELECT MAX(MID(invoice_sale,10,4)) AS invoice_no FROM t_sale WHERE MID(invoice_sale,4,6) = DATE_FORMAT(CURDATE(), '%y%m%d')";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $n = ((int)$row->invoice_no) + 1;
            $no = sprintf("%'.04d", $n);
        } else {
            $no = '0001';
        }
        $invoice = "STP".date('ymd').$no;
        return $invoice;
        // STP(221212)0001
    }

}
