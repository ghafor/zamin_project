<?php
class vehicle_model extends CI_Model {
	public function __construct() {
    parent::__construct();
     // load Pagination library
     $this->load->library('pagination');
     $this->load->helper('security');
    }
    public function add_vehicle($image,$filename) {  
      $this->db->insert('vehicle',  
			array(
				'name'=>$this->security->xss_clean($this->input->post('name')),
				'model'=>$this->security->xss_clean($this->input->post('model')),
				'plate'=>$this->security->xss_clean($this->input->post('plate')),
        'type'=>$this->security->xss_clean($this->input->post('category')),
        'img_url' => $filename
      )
    );
       

 
    }

		
		public function upload_doc_name($img_name,$id) {
			$data = array(
				'document_name' => $img_name,
				'user_id' => $id
			);
			$this->db->insert('document',$data);
		}
  
    public function add_mojrem($data) {
      $r = $this->db->insert('person',$data);
      $id = $this->db->insert_id();
      $_SESSION['last_insert_id'] = $id;
      return $id;
  }
  public function getalls(){
    $query=$this->db->query('select * from vehicle orderby id desc');
    return $query->result();
  }
  //change this function to return posts as offsets and limit
    public  function get_posts($limit = 5, $offset = 0)
      {
      return $this->db->get('vehicle',$limit,$offset)->result();
      }// create this function to count posts
      function count_posts()
      {
      return $this->db->count_all('vehicle');
      }
      public function fetch_data($query){
        $this->db->select("*");
        $this->db->from("vehicle");
        if($query!=''){

    $this->db->like('name',$query);
    $this->db->or_like('model',$query);
    $this->db->or_like('plate',$query);
    $this->db->or_like('type',$query);
  }
  $this->db->order_by('id','DESC');
  return $this->db->get();
}
public function getSingleposts($id){
  $query=$this->db->get_where('vehicle',array('id'=>$id));
  if($query->num_rows()>0){
    return $query->row();

  }
}public function updatepost($data,$id){
  return $this->db->where('id',$id)
                        ->update('vehicle',$data);

}
public function deleteposts($id){
  return $this->db->delete('vehicle',['id'=>$id]);
}

public function setting($id){
  $this->db->insert('setting',  
   $data=array(
     'key'=> $this->input->post('key'),
     'value'=>$this->input->post('value')
    )
  );
}
public function get_taxes() {
  $this->db->select('*')->from('setting');
  return $this->db->like('_key','tax')->get()->result_array();
}

public function update_setting($data) {
  $this->db->where('id',1);
  $this->db->update('setting',['value' => $data['car_tax']]);

  $this->db->where('id',2);
  $this->db->update('setting',['value' => $data['motor_tax']]);

  $this->db->where('id',3);
  $this->db->update('setting',['value' => $data['bycicle_tax']]);

  $this->db->where('id',4);
  $this->db->update('setting',['value' => $data['truck_tax']]);
  
  return true;
}

public function out_go_model($image,$filename) {  
    $this->db->insert('vehicse',  
    array(
      'name'=>$this->input->post('name'),
      'model'=>$this->input->post('model'),
      'plate'=>$this->input->post('plate'),
      'type'=>$this->input->post('category'),

      'img_url' => $filename
    )
  );
     


  }
}
