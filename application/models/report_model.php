<?php
class report_model extends CI_Model {
	public function __construct() {
		parent::__construct();
    }

    public function get_range_person($start,$end) {
        $this->db->select('*')->from('person');
        $this->db->where('date <=',$end);
        $this->db->where('date >=',$start);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_range_person_csv($start,$end) {
        $this->load->dbutil();
        $this->db->select('*')->from('person');
        $this->db->where('date <=',$end);
        $this->db->where('date >=',$start);
        $query = $this->db->get();
        $delimiter = ",";
        $newline = "\r\n";
        $enclosure = '"';
        return $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure);
      //  return $this->dbutil->csv_from_result($query);die;
    }


}