<?php defined('BASEPATH') OR exit('No direct script access allowed');
class setting extends CI_Controller {
 
	public function __construct() {
        parent::__construct();
        $this->load->model('vehicle_model');
       

    }


    public function index() {
        $data['taxes'] = $this->vehicle_model->get_taxes();
        $data['active'] = 'setting';
        $data['page_name'] = 'admin/setting';
        $this->load->view('main_template',$data);
    }

    public function update_setting(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'car_tax' => $this->input->post('1'), 
                'motor_tax' => $this->input->post('2'), 
                'bycicle_tax' => $this->input->post('3'), 
                'truck_tax' => $this->input->post('4') 
            ];
            $this->vehicle_model->update_setting($data);
            redirect('setting');
        }
    }

}