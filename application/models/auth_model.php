<?php
class auth_model extends CI_Model {
	public function __construct() {
		parent::__construct();
    }

    //login the admin
    public function login($data) {
      $u = $data['username'];
      $p = $data['password'];
      // die($p);
      $this->db->select('*')->from('admin');
      $this->db->join('privilage','admin.id = privilage.user_id');
      $this->db->where('username',$u);
      $this->db->where('password',$p);
      $res = $this->db->get();
      //$sql = "SELECT * FROM admin,privilage where admin.id=privilage.user_id and username='$u' and password='$p'";
      
      return ($res->num_rows() == 1) ? $res->result_array() : 'false';
    }
    
    public function check_pin($username,$pin) {
      $this->db->select('count(admin.id) as u');
      $this->db->from('admin');
      $this->db->join('recover','recover.user_id = admin.id');
      $this->db->where('admin.username',$username);
      $this->db->where('recover.pin',$pin);
      $query = $this->db->get();
      $query = $query->result_array();
      return $query[0]['u'] == 1; 
    }

    public function change_password($username,$pass) {
     $query =  $this->db->query("update admin set password='$pass' where username='$username'");
      return $query == 1; 
    }

}
