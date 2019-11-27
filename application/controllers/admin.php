<?php defined('BASEPATH') OR exit('No direct script access allowed');
class admin extends CI_Controller {
 
	public function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
        // $this->load->library('language');

        if(!isset($_SESSION['id'])) {
            redirect('auth/login');
        }
      
      date_default_timezone_set('Asia/kabul');
      
    }
    
    public function index() {

        //get the dashboard information ===== get_num($table,$whereClausecolumn,$whereclauseValue);
        $data['population'] = $this->admin_model->get_num('person');
        $data['population_male'] = $this->admin_model->get_num('person','gender','male');

        $data['population_female'] = $data['population'] - $data['population_male'];
        $data['admin'] = $this->admin_model->get_num('admin');
      
        $data['motors'] = $this->admin_model->count('motor')[0]->no;
        $data['trucks'] = $this->admin_model->count('truck')[0]->no;
        $data['cars'] = $this->admin_model->count('car')[0]->no;
        $data['bycicle'] = $this->admin_model->count('bycicle')[0]->no;

        //get the last 5 login and logout of admins 
        // $file = fopen(base_url().'assets/log/login_log.txt','r');
        // //reading last 5 actions taken by admins
        // $lines = array();
        // while(!feof($file)) {
        //     $line = fgets($file,4096);
        //     array_push($lines,$line);
        //     if(count($lines) > 6) {
        //         array_shift($lines);
        //     }
        // }
        // fclose($file);
        // $data['login_log'] = $this->login_process($lines);
      
        $data['active'] = 'dashboard';
        $data['page_name'] = 'admin/main';
       $this->load->view('main_template',$data);
      
       
    }

    //list mojrem
   

    //profiling
    public function profile() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
           
            $data  = array(

                'first_name' => htmlspecialchars(trim($this->input->post('first_name'))),
                'last_name' => htmlspecialchars(trim($this->input->post('last_name'))),
                'username' => htmlspecialchars(trim($this->input->post('username')))
            );
            //if password is changed do the following:
            if($_POST['password'] != '' && $_POST['confirm_password'] != '' ) {
                if($_POST['password'] == $_POST['confirm_password']) {
                    //encrypt and sore it in
                    
                   // $password = $this->change_to_english($_POST['password']);
                    $password  = $_POST['password'];
                    $data['password'] = htmlspecialchars(md5($password.'tondar'));
                }else {
                    //password does not match
                    $this->session->set_flashdata('status', 'رمز عبور و تکرار آن مطابقت ندارند');
                    $this->session->set_flashdata('type', 'danger');
                    redirect("admin/profile");
                }
            }//end of password handling

            //now update database and update photo then
            if($this->admin_model->update_admin($data))  {
                //image handlingi
                $p_url = $this->config->item('physic_url');
                if($_FILES['admin_photo']['name'] != '') {
                    
                    $path2 = $p_url.'img/admin_photos/';
                    $max_size = 2000;
                    $width=160;
                    $height=160;
                    $img_name = $_SESSION['image_name'].'.jpg';
                    $dir = $path2.$img_name;
                    
                    if(file_exists($dir)) {
                       // die('file exist!');
                       
                        unlink($dir);
                        
                    }
                    //upload admin photo

                    $r = $this->upload_image('admin_photo',$img_name,$path2,$max_size,$width,$height); 
                    
                    if($r != true) {
                        $this->session->set_flashdata('status', $r);
                        $this->session->set_flashdata('type', 'warning');
                        redirect('admin/profile');
                    }
                
                  }
                    $this->session->set_flashdata('status', 'اطلاعات بروز رسانی شد');
                    $this->session->set_flashdata('type', 'success');
                    redirect('admin/profile');
                
            }
            


        }   
        $data['admin_info'] = $this->admin_model->get_admin($_SESSION['id']);
        $data['active'] = 'profile';
        $data['page_name'] = 'admin/profile';
       $this->load->view('main_template',$data);
    }

    public function view_mojrem($id) {
       // $data['admin_info'] = $this->admin_model->get_admin($_SESSION['id']);
       $data['mojrem'] = $this->admin_model->get_single_mojrem($id);
       //change gretory date into jalali
       $date = $data['mojrem'][0]['date'];
       $date_arr =  explode('-',$date);
       $date_arr = $this->gregorian_to_jalali($date_arr[0],$date_arr[1],$date_arr[2]);
       $data['mojrem'][0]['date'] = implode('/',$date_arr);
       //end of date convering
       $data['documents'] = $this->admin_model->get_single_mojrem_docs($id);
       $data['active'] = 'list_mojrem';
       $data['page_name'] = 'admin/single';
       $this->load->view('main_template',$data);  
    }
    public function view_docs($id) {
        $data['id'] = $id;
        $data['documents'] = $this->admin_model->get_single_mojrem_docs($id);
       // print_r($data['documents']);die;
        $data['active'] = 'list_mojrem';
        $data['page_name'] = 'admin/view_docs';
        $this->load->view('main_template',$data); 
    }

    public function add_mojrem() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $image_name = time();
            //get all data from the form
            $data = array(
                'first_name' => trim(htmlspecialchars($_POST['first_name'])),
                'father_name' => trim(htmlspecialchars($_POST['father_name'])),
                'grand_father_name' => trim(htmlspecialchars($_POST['grand_name'])),
                'ssn' => trim(htmlspecialchars($_POST['ssn'])),
                'event_type' => trim(htmlspecialchars($_POST['event_type'])),
                'place' => trim(htmlspecialchars($_POST['event_place'])),
                'wakil' => trim(htmlspecialchars($_POST['wakil'])),
                'p_province' => trim(htmlspecialchars($_POST['p_province'])),
                'p_district' => trim(htmlspecialchars($_POST['p_district'])),
                'p_village' => trim(htmlspecialchars($_POST['p_village'])),
                't_gozar' => trim(htmlspecialchars($_POST['t_gozar'])),
                't_nahiya' => trim(htmlspecialchars($_POST['t_nahiya'])),
                't_province' => trim(htmlspecialchars($_POST['t_province'])),
                'related_employee_name' => trim(htmlspecialchars($_POST['em_name'])),
                'related_employee_number' => trim(htmlspecialchars($_POST['em_phone'])),
                'result' => trim(htmlspecialchars($_POST['result'])),
                'reason' => trim(htmlspecialchars($_POST['base'])),
                'person_image_name' => $image_name
            );
            
            //change date to gregorian
            $date = $this->ex_date(trim(htmlspecialchars($_POST['date'])));
            $date = $this->jalali_to_gregorian($date['year'],$date['month'],$date['day']);
            $data['date'] = $this->to_string($date);
           // print_r($data['date']);die;
            //insert data into database
            $inserted_id = $this->admin_model->add_mojrem($data);
            if($inserted_id > 0) {
                //if the text information is added successfully add upload images
                if($_FILES['mojrem_photo']['name'] != '') {
                    $path2 = './assets/img/person_photos/';
                    $max_size = 5000;
                    $width=1200;
                    $height=1200;
                    $upload_res = $this->upload_image('mojrem_photo',$data['person_image_name'],$path2,$max_size,$width,$height);
                    
                    if($upload_res != 1) {
                        $this->admin_model->reverse_add($inserted_id);
                        $data['rev'] = $data;
                        $this->session->set_flashdata('data',$data);
                        $this->session->set_flashdata('status', 'نوعیت و یا سایز عکس مشکل دارد!');
                        $this->session->set_flashdata('type', 'warning');
                       
                        redirect('admin/add_mojrem');
                    }

                }else {
                    $this->admin_model->reverse_add($inserted_id);
                    $data['rev'] = $data;
                    $this->session->set_flashdata('data',$data);
                    $this->session->set_flashdata('status', 'عکس مجرم انتخاب نشده است!');
                    $this->session->set_flashdata('type', 'warning');
                    redirect('admin/add_mojrem');
                }
                //call the method after execution
                $this->session->set_flashdata('status', 'مجرم با موفقیت ثبت شد!');
                $this->session->set_flashdata('type', 'success');
                redirect("admin/add_document/$inserted_id");
            }
            //work with date
        }else {
            $data['active'] = 'add_mojrem';
            $data['page_name'] = 'admin/add_mojrem';
            $this->load->view('main_template',$data);
        }
       
    }


    // add document after completion of the registration
    public function add_document($id = null) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //upload all the documents has been uploaded
            $id = $_POST['id'];
         if($_FILES['documnets']['name'][0] != '') {
            //first try to upload, 
            $files = $_FILES['documnets'];
            $number_of_files = sizeof($_FILES['documnets']['tmp_name']);
            $document_data = array();
            //upload multiple while looping
            $image_name = time();
            for ($i = 0; $i < $number_of_files; $i++) {
               // $image_name += $i;
               if($i != 0 ) {
                $document_data["image$i"] = $image_name . $i;
               } else {
                $document_data["image$i"] = $image_name;
               }
               //set the image name
                $path1='./assets/img/document/';
                $max_size = 3000;
                $_FILES['uploadedimage']['name'] = $files['name'][$i];
                $_FILES['uploadedimage']['type'] = $files['type'][$i];
                $_FILES['uploadedimage']['tmp_name'] = $files['tmp_name'][$i];
                $_FILES['uploadedimage']['error'] = $files['error'][$i];
                $_FILES['uploadedimage']['size'] = $files['size'][$i];
                $arr[$i] = $this->upload_image('uploadedimage',$image_name,$path1,$max_size,1024,768,false,true);
                
            }
        
            //then update database for documents
            $this->admin_model->add_mojrem_document($document_data,$id);

            $this->session->set_flashdata('status', 'مجرم با موفقیت ثبت شد!');
            $this->session->set_flashdata('type', 'success');
            redirect("admin/list_mojrem");
            }
        }else {
            $data['id'] = $id;
            $data['active'] = 'add_mojrem';
            $data['page_name'] = "admin/add_document";
            $this->load->view('main_template',$data);
        }    
    }
    //list mojrems
    public function list_mojrem($start=0) {

        $this->load->library('pagination');
        //include searching
        $type = $keyword = "";
        if(isset($_GET['keyword'])) {
            
            $type = $_GET['type'];
            $keyword = $_GET['keyword'];
            if($type =='ssn') {
                $keyword = $this->change_to_english($keyword);
            }
            $_SESSION['type'] = $type;
            $_SESSION['keyword'] = $keyword;

            $data['type_back'] = $type;
            $data['keyword'] = $keyword;
        }else {

            if(isset($_SESSION['type']) && isset($_SESSION['keyword'])) {
                $data['type'] = $type = $_SESSION['type'];
                $data['keyword'] = $keyword = $_SESSION['keyword'];
            }

        }
        //set up pagination
        $data['mojrems'] = $this->admin_model->get_mojrems(5,$start,$keyword,$type);
        $data['total_rows'] = $config['total_rows'] = $this->admin_model->get_mojrem_count($keyword,$type);
        $config['base_url'] = base_url().'admin/list_mojrem/';
        $config['per_page'] = 5;
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '<li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close']  ='</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();


        $data['active'] = 'list_mojrem';
        $data['page_name'] = 'admin/list_mojrem';
        $this->load->view('main_template',$data);
    }
        //list mojrems
        public function uploader() {
            $this->load->view('admin/uploader');
        }

        public function upload_docs($id) {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                if($_FILES['img']['name'] != '') {
                    $path2 = './assets/img/document/';
                    $max_size = 5000;
                    $width=2400;
                    $height=3500;
                    $img_name = time();
                    //upload_image($form_name,$filename,$path,$max_size,$width,$height,$thumbnail = true,$no_resize=false)
                    $r = $this->upload_image('img',$img_name.'.jpg',$path2,$max_size,$width,$height); 
                   if($r == 'true') {
                       //file successsfully uploaded and save its name into database
                        $this->admin_model->upload_doc_name($img_name,$id);
                        redirect("admin/view_docs/$id");
                   }else {
                       die('قادر به آپلود نیست!');
                   }
                } {
                    redirect("admin/view_docs/$id");
                }
            }
        }
        //list the admins
    public function admins() {
        $data['active'] = 'admin';
        $data['page_name'] = 'admin/admins';
        $data['list_admin'] = $this->admin_model->get_admins();
        $this->load->view('main_template',$data);
    } 
    public function delete_doc() {
        //echo 'hi babe';
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(isset($_POST['img'])) {
               
                $p_u = $this->config->item('physic_url');
                $name = $_POST['img'];
                $url = $p_u.'img/document/'.$name.'.jpg';
                if(file_exists($url)) {
                    unlink($url);
                    if($this->admin_model->delete_doc($name)) {
                        echo 'true';
                    }else {
                        echo 'false';
                    }
                    
                }
            }
        }
     }
//remove admins
    public function remove_admin($id,$state=null) {
        //this is for confirming to remove
        if($state == 'true' || $state == 'false') {
            if($state == 'false') {
                redirect('admin/admins');
            }elseif($this->session->id == $id) {
                $this->session->set_flashdata('status', 'خودتان را حذف نمی توانید!');
                $this->session->set_flashdata('type', 'warning');
                redirect('admin/admins');
            }elseif($state=='true') {
                $this->admin_model->remove_admin($id);
                $this->session->set_flashdata('status', 'مدیر با موفقیت حذف شد!');
                $this->session->set_flashdata('type', 'success');
                redirect('admin/admins');
            }
        }else { //in order to show confirm delete message
            $data['active'] = 'admin';
            $data['page_name'] = 'admin/confirm_delete';
            $data['admin'] = $this->admin_model->get_admin($id);
            $this->load->view('main_template',$data);
        }
       
    }
    public function previlage_admin($id) {
        //if the data is posted!
        if(isset($_POST['submit'])) {
            $level = $this->input->post('level');
            $is_super = false;
            if($level != 1) {
                $data = array(
                    'delete_person' => $this->input->post('delete_p'),
                    'write_person' => $this->input->post('write_p'),
                    'add_admin' => $this->input->post('add_p'),
                    'user_id' => $id
                );
                if($data['delete_person'] == 1 && $data['write_person'] == 1 && $data['add_admin'] == 1) {
                    //for changing level to super user
                    $this->admin_model->upgrade_level($id);
                }
            }else {
                $data = array(
                    'delete_person' => '1',
                    'write_person' => '1',
                    'add_admin' => '1',
                    'user_id' => $id
                );
                //for changing level to super user
                $this->admin_model->upgrade_level($id);
            }
            if($this->admin_model->update_setting($data)) {
                $this->session->set_flashdata('status', 'تنظیمات با موفقیت ویرایش شد!');
                $this->session->set_flashdata('type', 'success');
            }else {
                $this->session->set_flashdata('status', 'تنظیمات ویرایش نشد!');
                $this->session->set_flashdata('type', 'warning'); 
            }
            redirect('admin/admins');
            
        }else {
            $data['active'] = 'admin';
            $data['page_name'] = 'admin/permission';
            $data['admin'] = $this->admin_model->get_admin_permission($id);
            
            if($data['admin'][0]['level'] == 1) {
                $this->session->set_flashdata('status', 'شما اجازه تغییرات دسترسی مدیر درجه اول را ندارید!');
                $this->session->set_flashdata('type', 'warning');
                redirect('admin/admins');
            }
            
            $this->load->view('main_template',$data);
        }
    }
    //add admin
    public function add_admin() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = array();
            //saving, validation, and inserting data
            //password is hashed through Argon2I
            $image_name = time();
            $data = array(
            'first_name' => htmlspecialchars(trim($_POST['first_name'])),
            'last_name' => htmlspecialchars(trim($_POST['last_name'])),
            'username' => htmlspecialchars(trim($_POST['username'])),
            'password' => md5(trim($_POST['password']).'zamin'),
            'level' =>$_POST['level'],
            'image_name' => $image_name
            );
            //validation starts
            if(empty($data['first_name']) || empty($data['last_name']) || empty($data['username']) || empty($data['password'])) {
                $errors['error'] = '<p>اطلاعات خالی بوده نمیتواند!</p>';
            }
        
        
            if(floor($_FILES['admin_photo']['size']/1024) > 5000 || $_FILES['admin_photo']['type'] != 'image/jpeg') {
                $errors['error'] = '<p>سایز تصویر و یا نوعیت آن مشکل دارد، دوباره تلاش کنید!</p>';
                

            }


            if(empty($errors)) {
                //save in the database
                if($this->admin_model->add_admin($data)) {
                    //image uploading
                    $filename = $image_name;
                    $path = './assets/img/admin_photos/';
                    $max_size = 5500;
                    $width = 160;
                    $height = 160;

                    $this->upload_image('admin_photo',$filename,$path,$max_size,$width,$height);                   
                    $this->session->set_flashdata('status', 'مدیر با موفقیت اضافه شد!');
                    $this->session->set_flashdata('type', 'success');
                    redirect('admin/admins');
                }
            }else {
                //return to add admin page
                $this->session->set_flashdata('status', $errors['error']);
                $this->session->set_flashdata('type', 'danger');
                redirect('admin/add_admin');
            }
        }else {
            $data['active'] = 'add_admin';
            $data['page_name'] = 'admin/add_admin';
            $this->load->view('main_template',$data);
        }  
    }


    //about us method

    public function about_us() {
        $data['active'] = 'about_us';
        $data['page_name'] = 'admin/about_us';
        $this->load->view('main_template',$data);   
    }

    //editing mojrem
    public function edit_mojrem($id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

        }else {
            $data['mojrem'] = $this->admin_model->get_single_mojrem($id);
            //change gretory date into jalali
            $date = $data['mojrem'][0]['date'];
            $date_arr =  explode('-',$date);
            $date_arr = $this->gregorian_to_jalali($date_arr[0],$date_arr[1],$date_arr[2]);
            $data['mojrem'][0]['date'] = implode('/',$date_arr);
            //end of date convering
            $data['documents'] = $this->admin_model->get_single_mojrem_docs($id);
            $data['active'] = 'list_mojrem';
            $data['page_name'] = 'admin/edit_mojrem';
            $this->load->view('main_template',$data);  
        }
    }


    public function design_pagination() {
        $config['full_tag_open']  = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = "<li class='active'><a href='#'>";
        $config['num_tag_close'] = "</a></li>";
        $config['full_tag_open'] = "<li>";
        $config['full_tag_close'] = "</li>";
        $config['full_tag_open'] = "<li>";
        $config['full_tag_close'] = "</li>";
        $config['full_tag_open'] = "<li>";
        $config['full_tag_close'] = "</li>";
        $cofig['prev_link'] = "<i class='fa fa-long-arrow-left'></i>Prev";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tag_close'] = "</li>";
        $cofig['next_link'] = "<i class='fa fa-long-arrow-right'></i>Next";
        $config['next_tag_open'] = "<li>";
        $config['next_tag_close'] = "</li>";
        return $config;
        
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
		return $result;	
    }

    public function delete_mojrem_confirm($id,$state = null) {
       
        if($state == 'true') {
            $this->delete_mojrem($id);
        }elseif($state == 'false') {
            redirect('admin/list_mojrem');
        }
        $data['id'] = $id;
        $data['active'] = 'list_mojrem';
        $data['page_name'] = 'admin/confirm_delete_person';
        $this->load->view('main_template',$data);

    }
    //delete mojrem
    public function delete_mojrem($id) {
        
        //get image name
        $mojrem_image = $this->admin_model->get_image_name($id);
        //get documents names
       
        $data['documents'] = $this->admin_model->get_documents_name($id);
       // print_r($data['documents']);die;
        //delete from person table
        $this->admin_model->delete_row('person',$id);

        //now unlink all the files exist in the file folder
        $p_url = $this->config->item('physic_url');
        
        if(file_exists($p_url.'img/person_photos/'.$mojrem_image.'.jpg')) {
            unlink($p_url.'img/person_photos/'.$mojrem_image.'.jpg');
        }else {
            die('profile picture does not found!');
        }
        //print_r($data['documents']);die;
        $z =0;
        while($data['documents'][$z]) {
            $row = $data['documents'][$z++];
            $row = $row['document_name'];

           $URL = $p_url.'img/document/'.$row;
            if(file_exists($URL.'.jpg')) {
                unlink($URL.'.jpg');
            }else {
                die('document could not found!');
            }
        }//die;

        //$this->session->set_flashdata('status', 'مجرم با موفقیت حذف شد!');
        //$this->session->set_flashdata('type', 'success');
        redirect('admin/list_mojrem');


    }
    
    //a function for resizing images
    // resize($path,$filename,$width,$height,$ratio = true,$thumbnail = false)
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

      public function to_string($date) {
        return $date[0].'-'.$date[1].'-'.$date[2];
    }

        //return mixed: 'false' on wrong date, 'assoc' array in correct date
        public function ex_date($date) {
            //1374/10/24
            $arr = explode('/',$date);
            $errors = array();
            if(count($arr) != 3) {
                return false;
            } 
            if(strlen($arr[0]) != 4 || strlen($arr[1]) >2 || strlen($arr[2]) >2) {
                return false;
            }
            $arr = array(
                'year' => $arr[0],
                'month' => $arr[1],
                'day' => $arr[2]
            );
            return $arr;
        }

        //change persian digits into english
        public function change_to_english($digit) {
            return strtr($digit,array('۰'=>'0','۱'=>'1','۲'=>'2','۳'=>'3','۴'=>'4','۵'=>'5','۶'=>'6','۷'=>'7','۸'=>'8','۹'=>'9'));
        }


      public function jalali_to_gregorian($jy,$jm,$jd,$mod=''){
        if($jy>979){
         $gy=1600;
         $jy-=979;
        }else{
         $gy=621;
        }
        $days=(365*$jy) +(((int)($jy/33))*8) +((int)((($jy%33)+3)/4)) +78 +$jd +(($jm<7)?($jm-1)*31:(($jm-7)*30)+186);
        $gy+=400*((int)($days/146097));
        $days%=146097;
        if($days > 36524){
         $gy+=100*((int)(--$days/36524));
         $days%=36524;
         if($days >= 365)$days++;
        }
        $gy+=4*((int)($days/1461));
        $days%=1461;
        if($days > 365){
         $gy+=(int)(($days-1)/365);
         $days=($days-1)%365;
        }
        $gd=$days+1;
        foreach(array(0,31,(($gy%4==0 and $gy%100!=0) or ($gy%400==0))?29:28 ,31,30,31,30,31,31,30,31,30,31) as $gm=>$v){
         if($gd<=$v)break;
         $gd-=$v;
        }
        return($mod=='')?array($gy,$gm,$gd):$gy.$mod.$gm.$mod.$gd; 
       }
        // converter code
    public function gregorian_to_jalali($gy,$gm,$gd,$mod=''){
        $g_d_m=array(0,31,59,90,120,151,181,212,243,273,304,334);
        if($gy>1600){
        $jy=979;
        $gy-=1600;
        }else{
        $jy=0;
        $gy-=621;
        }
        $gy2=($gm>2)?($gy+1):$gy;
        $days=(365*$gy) +((int)(($gy2+3)/4)) -((int)(($gy2+99)/100)) +((int)(($gy2+399)/400)) -80 +$gd +$g_d_m[$gm-1];
        $jy+=33*((int)($days/12053)); 
        $days%=12053;
        $jy+=4*((int)($days/1461));
        $days%=1461;
        if($days > 365){
        $jy+=(int)(($days-1)/365);
        $days=($days-1)%365;
        }
        $jm=($days < 186)?1+(int)($days/31):7+(int)(($days-186)/30);
        $jd=1+(($days < 186)?($days%31):(($days-186)%30));
        return($mod=='')?array($jy,$jm,$jd):$jy.$mod.$jm.$mod.$jd;
    }



    










    }

