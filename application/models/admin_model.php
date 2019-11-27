<?php
class admin_model extends CI_Model {
	public function __construct() {
		parent::__construct();
    }


    public function get_admins() {
        $this->db->select('*')->from('admin');
        $query = $this->db->get();
        return $query->result_array();

    }

    public function get_admin($id) {
        $this->db->select('*')->from('admin')->where('id',$id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function count($arg) {
        $q = $this->db->query("SELECT COUNT(id) as no from vehicle where type='$arg'");
        return $q->result();
    }
    public function remove_admin($id) {
        $this->db->where('id',$id);
        $this->db->delete('admin');
    }
    public function get_admin_permission($id) {
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->join('privilage','admin.id = privilage.user_id');
        $this->db->where('admin.id',$id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function update_setting($data) {
        $this->db->where('user_id', $data['user_id']);
        $this->db->update('privilage', $data);
        return true;
    }
    //update admin
    public function update_admin($data) {
        $this->db->where('id', $_SESSION['id']);
        $r = $this->db->update('admin', $data);
        return $r;
    }
    public function upgrade_level($id) {
        $this->db->query("update admin set level='1' where id='$id'");
    }

    public function add_admin($data) {
        $this->db->insert('admin',$data);
        $last_id = $this->db->insert_id();
        //setting permissions for super admin and simple admin
        if($data['level'] == '1') {
            $p = array(
                'user_id' => $last_id,
                'read_person' => '1',
                'write_person' => '1',
                'delete_person' => '1',
                'add_admin' => '1'
            );
        }else {
            $p = array(
                'user_id' => $last_id,
                'read_person' => '1',
                'write_person' => '0',
                'delete_person' => '0',
                'add_admin' => '0'
            );
        }
        
        $this->db->insert('privilage',$p);
        return true;
    }

    public function get_num($table,$column = null,$value = null) {
        $this->db->select('count(*) as u');
        $this->db->from($table);
        if($column != null && $value != null) {
            $this->db->where($column,$value);
        }
        $query = $this->db->get();
        $query = $query->result_array();
        return $query[0]['u'];
    }

    public function add_mojrem($data) {
        $r = $this->db->insert('person',$data);
        $id = $this->db->insert_id();
        $_SESSION['last_insert_id'] = $id;
        return $id;
    }

    public function add_mojrem_document($document_data,$id) {
        if(isset($id)) {
            foreach($document_data as $row) {
                $data = array(
                    'user_id' => $id,
                    'document_name' => $row
                );
                $this->db->insert('document', $data);
            }

            
        }else {
            die('ID for insertion of document is not set yet! <br>please check it!');
        }
       

    }

    public function get_mojrems($per_page,$start,$keyword='',$type='') {
        $this->db->select('*')->from('person');

        //handle searching...
        if($keyword != '' && $type == 'ssn') {
            $this->db->where('ssn',(int)$keyword);
        }elseif($keyword != '' && $type != '') {
            $this->db->like($type,$keyword);
        }
        //end of searching

        $this->db->limit($per_page,$start);
        $query = $this->db->get();
        return $query->result_array();
    }


    public function get_mojrem_count($keyword = '',$type = '') {
        $this->db->select('count(id) as c')->from('person');
        //handle searching...
        if($keyword != '' && $type == 'ssn') {
            $this->db->where('ssn',$keyword);
        }elseif($keyword != '' && $type != '') {
            $this->db->like($type,$keyword);
        }
        //end of searching

        $query = $this->db->get();
        $query = $query->result_array();
        return $query[0]['c'];
    }

    public function get_image_name($id) {
        $this->db->select('person_image_name')->from('person')->where('id',$id);
        $q = $this->db->get();
        $q = $q->result_array();
        return $q[0]['person_image_name'];
    }

    public function get_documents_name($id) {
        $this->db->select('document_name')->from('document')->where('user_id',$id);
        $q = $this->db->get();
        $q = $q->result_array();
        return $q;
    }
    public function delete_row($table,$id) {
        $this->db->delete($table,array('id'=> $id));
    }

    public function reverse_add($inserted_id) {
        $this->db->delete('person',array('id'=>$inserted_id));
    }
    public function get_single_mojrem($id) {
        //return mojrem info
        $this->db->select('*')->from('person')->where('id',$id);
        $query = $this->db->get();
        return $query->result_array();
      
    }
    public function get_single_mojrem_docs($id) {
        $this->db->select('*')->from('document')->where('user_id',$id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function delete_doc($name) {
        $r = $this->db->query("delete from document where document_name = '$name'");
        return $r == '1';
    }

    public function upload_doc_name($img_name,$id) {
        $data = array(
            'document_name' => $img_name,
            'user_id' => $id
        );
        $this->db->insert('document',$data);
    }



}