<?php defined('BASEPATH') OR exit('No direct script access allowed');
class vehicle extends CI_Controller {
 
	public function __construct() {
        parent::__construct();
        $this->load->model('vehicle_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
        $this->load->helper('date');
        
    }
    public function index() {
        echo 'hi';
    }


    public function add_vehicle() {
        
        if (isset($_POST['submit'])){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name','name of vehicle','required');
            
            $this->form_validation->set_rules('model','Model of vehicle','required');
                if($this->form_validation->run()==TRUE){
                    //if ($this->input->post("submit")){
                $today=date('y-m-d');
                $data['date_created']=$today;
                $filename = time();
                $path = './assets/uploads/';
                $max_size = 5500;
                $width = 160;
                $height = 160;
                $data = $this->upload_image('car_photo',$filename,$path,$max_size,$width,$height); 
                $this->load->model('vehicle_model');
                $this->vehicle_model->add_vehicle($this->input->post('submit'),$filename);
                redirect('vehicle/add_vehicle'); 
                } else {
                    $data['errors'] = validation_errors();
                    $data['view']='vehicle/add_vehicle';
                    $data['active'] = 'add_vehicle';
                    $data['page_name'] = 'admin/add_vehicle';
                    $this->load->view('main_template',$data); 
                }
             

        }else{
            $data['title']=' registration page vehicle ';
            $this->load->helper('form');
            $data['view']='vehicle/add_vehicle';
            $data['active'] = 'add_vehicle';
            $data['page_name'] = 'admin/add_vehicle';
            $this->load->view('main_template',$data); 
    //    if($this->input->post('submit')){
           
        // }
    }
    }
    
    public function list_vehicle() {
        
         //get function model where get this model
         //$retu= $this->vehicle_model->getalls();
         //print_r($retu);die;
         //$data['re']=$retu;
         //////pagenition
      
            //second specify which segment of URI should be sent as offset
            $offset=$this->uri->segment(3);
            //third specify the base URL
            $config['base_url'] = base_url().'index.php/vehicle/list_vehicle';
            //fourth specifying total rows so we can count it
            $config['total_rows'] =$this->vehicle_model->count_posts();
            //fifth to specify how many posts in one page should be shown
            $config['per_page'] = 5;
            //six we need to know according to which segment of URI pagination proceeded
            $config['uri_segment'] = 3;
            //we need to initialize the settings
        //     $config['full_tag_open']    = "<ul class='pagination'>";
           
        // $config['full_tag_close']   = "</ul>";
        // $config['num_tag_open']     = '<li>';
        // $config['num_tag_close']    = '</li>';
        // $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='#'>";
        // $config['cur_tag_close']    = "<span class='sr-only'></span></a></li>";
        // $config['next_tag_open']    = "<li>";
        // $config['next_tagl_close']  = "</li>";
        // $config['prev_tag_open']    = "<li>";
        // $config['prev_tagl_close']  = "</li>";
        // $config['first_tag_open']   = "<li>";
        // $config['first_tagl_close'] = "</li>";
        // $config['last_tag_open']    = "<li>";
        // $config['last_tagl_close']  = "</li>";
        $config["full_tag_open"] = '<ul class="pagination">';
$config["full_tag_close"] = '</ul>';	
$config["first_link"] = "&laquo;";
$config["first_tag_open"] = "<li>";
$config["first_tag_close"] = "</li>";
$config["last_link"] = "&raquo;";
$config["last_tag_open"] = "<li>";
$config["last_tag_close"] = "</li>";
$config['next_link'] = 'Prev';
$config['next_tag_open'] = '<li>';
$config['next_tag_close'] = '<li>';
$config['prev_link'] = 'Next';
$config['prev_tag_open'] = '<li>';
$config['prev_tag_close'] = '<li>';
$config['cur_tag_open'] = '<li class="active"><a href="#">';
$config['cur_tag_close'] = '</a></li>';
$config['num_tag_open'] = '<li>';
$config['num_tag_close'] = '</li>';
        
       


            $this->pagination->initialize($config);
            //call a function from the model to return posts
            $data['vehicle']=$this->vehicle_model->get_posts($config['per_page'],$offset);
         /////////////////////////
        $data['active'] = 'list_vehicle';
        $data['page_name'] = 'admin/list_vehicle';
       $this->load->view('main_template',$data); 
    }
    public function out_put1(){
            //second specify which segment of URI should be sent as offset
            $offset=$this->uri->segment(3);
            //third specify the base URL
            $config['base_url'] = base_url().'index.php/vehicle/out_vehicle';
            //fourth specifying total rows so we can count it
            $config['total_rows'] =$this->vehicle_model->count_posts();
            //fifth to specify how many posts in one page should be shown
            $config['per_page'] = 5;
            //six we need to know according to which segment of URI pagination proceeded
            $config['uri_segment'] = 3;
         
        
        $config["full_tag_open"] = '<ul class="pagination">';
$config["full_tag_close"] = '</ul>';	
$config["first_link"] = "&laquo;";
$config["first_tag_open"] = "<li>";
$config["first_tag_close"] = "</li>";
$config["last_link"] = "&raquo;";
$config["last_tag_open"] = "<li>";
$config["last_tag_close"] = "</li>";
$config['next_link'] = 'Prev';
$config['next_tag_open'] = '<li>';
$config['next_tag_close'] = '<li>';
$config['prev_link'] = 'Next';
$config['prev_tag_open'] = '<li>';
$config['prev_tag_close'] = '<li>';
$config['cur_tag_open'] = '<li class="active"><a href="#">';
$config['cur_tag_close'] = '</a></li>';
$config['num_tag_open'] = '<li>';
$config['num_tag_close'] = '</li>';
        
       


            $this->pagination->initialize($config);
            //call a function from the model to return posts
            $data['out_put']=$this->vehicle_model->get_posts($config['per_page'],$offset);
         /////////////////////////
        $data['active'] = 'list_vehicle';
        $data['page_name'] = 'admin/out_vehicle';
       $this->load->view('main_template',$data); 
    }
    public function getall(){
        //add model
        $this->load->model('vehicle_model');
       
        //get function model where get this model
        $retu= $this->vehicle_model->listvehicle();
       
        $data['re']=$retu;
         //view loading
         $this->load->view('list_vehicle',$data);


       // var_dump($retu);


    }

    // image manipulation **********************************************************
    public function upload_image($form_name,$filename,$path,$max_size,$width,$height,$thumbnail = true,$no_resize=false) {
		if($_FILES[$form_name]['name'] !== ''){
            $config['upload_path']          =$path; //'./assets/img/posts/';
            $config['allowed_types']        = 'jpg';
            $config['max_size']  = $max_size;
            $config['file_name'] = $filename;
            $config['max_width'] = 2000;
            $config['max_height'] = 2000;
            $this->load->library('upload', $config);

            if($this->upload->do_upload($form_name)) {
                $data = array('upload_data' => $this->upload->data());
                if(!$no_resize) {
                 $this->resize($data['upload_data']['full_path'],$data['upload_data']['file_name'],$width,$height,true);
                }
                 $result = true;
            }else {
                $error = array('error' => $this->upload->display_errors());
                $result = $this->upload->display_errors();
            }	
            }else {
            $result = 'Image is exist in the specified path';
            }
		return $result;// == true ? $data : $result;	
    }
    public function resize($path,$filename,$width,$height,$ratio = true,$thumbnail = false) {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $path;
        $config['create_thumb'] = $thumbnail;
        $config['maintain_ratio'] = $ratio;
        $config['width']         = $width;
        $config['height']       = $height;
        $config['new_image'] = $path;
        $this->load->library('image_lib',$config);
        $this->image_lib->resize();
      }
      public function fetch(){
          $output='';
          $query='';
          $this->load->model('vehicle_model');
          if($this->input->post('query')){
              $query=$this->input->post('query');
          }
          $data=$this->vehicle_model->fetch_data($query);
          $output .='
          <div class="table-responsive">
          <table class="table table-bordered
          table-striped">
          <tr>
          <th> Car Name</th>
          <th> Car Modek</th>
          <th> Car plate</th>
          <th> Car Type</th>
          </tr>

          ';
          if($data->num_rows()>0){

            foreach($data->result() as $row){
                $output .='
                <tr>
                    <td>'.$row->name.'</td>
                    <td>'.$row->model.'</td>
                    <td>'.$row->plate.'</td>
                    <td>'.$row->type.'</td>
                </tr>
                ';
            }
          }
          else{

            $output .='<tr>
            <td colspan="4">No Data found </td>
            </tr>';
          }
          $output .='</table>';
          echo $output;
      }
      public function edit($id = null){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //
           // echo 'reached!';
           $data = [

            'name'=>$this->input->post('name'),
            'model'=>$this->input->post('model'),
            'plate'=>$this->input->post('plate'),
            'type'=>$this->input->post('category'),
      
            
            ];
           $id = $this->input->post("id_field");
            return $this->vehicle_model->updatepost($data,$id);

            

        }else {
            $this->load->model('vehicle_model');
            $data['post']= $this->vehicle_model->getSingleposts($id);
            
             // $this->load->view('admin/car/edit',['post'=>$post]);
             $data['active'] = 'add_vehicle';
              $data['page_name'] = 'admin/car/edit';
           $this->load->view('main_template',$data); 
        }
          }
          public function delete($id){
            $this->load->model('vehicle_model');
        if($this->vehicle_model->deleteposts($id)){
            // $data['active'] = 'list_vehicle';
            // $data['page_name'] = 'admin/list_vehicle';
            // $this->load->view('main_template',$data); 
            redirect('vehicle/list_vehicle');
        }else{
            echo "not deletet";
        }
          
          }
          public function set_setting(){
            $this->load->model('vehicle_model');
            $this->vehicle_model->setting($this->input->post('submit'));
           redirect('vehicle/setting');  
              
          }
          public function out_go($id){
            $this->load->model('vehicle_model');
            if($this->vehicle_model->out_go_model($id)){
                $this->load->view('main_template',$data); 
            }else{
                echo "not out go ";
            }



          }
      }
    

    


