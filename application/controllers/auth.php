<?php defined('BASEPATH') OR exit('No direct script access allowed');
class auth extends CI_Controller {
 
	public function __construct() {
		parent::__construct();
        $this->load->model('auth_model');
        date_default_timezone_set('Asia/kabul');
        
    }
    
    public function login() {
        if(isset($_SESSION['id'])) {
            redirect('admin/');
        }

        $errors = array();
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $username = $this->input->post('username');
            $password = md5($this->input->post('password').'tondar');
            
                $data = array(
                    'username' => $username,
                    'password' => $password
                );
                //check the database for the user
                $result = $this->auth_model->login($data);
                //if user is not logged in redirect to login page
                if($result == 'false')  {
                    $errors['login_err'] = 'نام کاربری یا رمز شما اشتباه است!';     
                    // $this->load->view('auth/login',$errors);
                }else {
                    //execut the session method
                    $this->create_session($result) or die("could not login :(");
                    //redirect to admin panel
                    //log login and logout of the users 
                    if($this->login_log('login')) {
                        redirect('admin');
                        exit;
                    }
                   
                }
            
        }      
        $this->load->view('auth/login',$errors);
    }

    //recovery option for the admin
    public function recovery() {
        $errors = array();
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            if(isset($_POST['username']) && isset($_POST['pin'])) {
                        $username = $_POST['username'];
                        $pin = $_POST['pin'];
                        if($this->auth_model->check_pin($username,$pin)) {
                            $_SESSION['username_temp'] = $username;
                            redirect("auth/change_password");
                            exit;
                            //echo 'success!';
                        }else {
                        $errors['pin_err'] = 'Your pin code or username is wrong!';
                        }
                    }
        }
            $this->load->view('auth/recover',$errors);
        
    }

    //for changing password
    public function change_password() {
        $errors = array();
        if($_SERVER['REQUEST_METHOD'] == 'POST')  {
            $pass = $_POST['password'];
            $conf_pass = $_POST['confirm_password'];
            $username = $_SESSION['username_temp'];
           
            if($pass == $conf_pass) {
                $pass = md5($pass.'tondar');
                if($this->auth_model->change_password($username,$pass)) {
                    unset($_SESSION['username_temp']);
                    sleep(2);
                    redirect('auth/login');
                    exit;
                }else {
                    $errors['cp_err'] = 'Process has broken, username may be wrong!';
                }
            }else {
                $errors['cp_err'] = 'Password does not match!';
            }

        }
            $this->load->view('auth/change_password',$errors);
        
    }

    


    //saving admin's info while loggin in
    public function create_session($data) {
      //adding array suddenly into session
        $user_data = array(
            'username' => $data[0]['username'],
            'first_name' => $data[0]['first_name'],
            'last_name' => $data[0]['last_name'],
            'level' => $data[0]['level'],
            'image_name' => $data[0]['image_name'],
            'id' => $data[0]['id'],
            'write_person' => $data[0]['write_person'],
            'delete_person' => $data[0]['delete_person'],
            'add_admin' => $data[0]['add_admin']
        );
        $this->session->set_userdata($user_data);
        return TRUE;
    }
    //logout the users from admin panel
    public function logout() {
        if($this->login_log('logout')) {
            $this->session->sess_destroy();
            redirect('auth/login');
            exit;
        }   
    }

    //log every login and logout of the database
    public function login_log($action) {
        $fp = fopen('./assets/log/login_log.txt','a+') or die('could not log!');
        //info
        $mytime = date('h:m:sa');
        $mydate = date('Y-m-d-l');
        $fn = $this->session->first_name;
        $ln = $this->session->last_name;
        $username = $this->session->username;
        $id = $this->session->id;

        $txt = "[action: $action] [time:$mytime , date:$mydate] [user_id:$id , username: $username] [fisrt_name:$fn , last_name:$ln]".PHP_EOL;
        $r =  fwrite($fp,$txt);
        if(!$r) {
            die('could not write log!');
        }
        fclose($fp);
        return true;
    }

    
    public function change_language($lang) {
        $this->session->set_userdata('lang',$lang);
        redirect('admin');
    }
   
    
}

