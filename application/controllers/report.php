<?php defined('BASEPATH') OR exit('No direct script access allowed');
class report extends CI_Controller {
 
	public function __construct() {
		parent::__construct();
        $this->load->model('report_model');
        $this->load->library('Csvimport');
        date_default_timezone_set('Asia/kabul');
        
    }


       //reporting pages
       public function index() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

        }else {
            $data['active'] = 'report';
            $data['page_name'] = 'admin/report';
            $this->load->view('main_template',$data);
        }
        
    }

    public function general_report() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data['start_general_value'] = $start_date = $_POST['start_date'];
            $data['end_general_value'] = $end_date = $_POST['end_date'];

            //format dates
            $start = $this->ex_date($start_date);
            $end = $this->ex_date($end_date);
            //on error of dates
            if(!$start || !$end) {
                $this->session->set_flashdata('status', 'تاریخ را اشتباه وارد کرده اید!');
                $this->session->set_flashdata('type', 'danger');
                redirect('report/');
            }
            //convert into gregory
            $start_date = $this->jalali_to_gregorian($start['year'],$start['month'],$start['day']);
            $end_date = $this->jalali_to_gregorian($end['year'],$end['month'],$end['day']);
            //change array to string format date (yyyy-mm-dd)
            $start_date = $this->to_string($start_date);
            $end_date = $this->to_string($end_date);

            $data['persons_tmp'] = $this->report_model->get_range_person($start_date,$end_date);

            //if the data is empty try not to send it!
           if(!empty($data['persons_tmp'])) {
            $data['persons'] = $data['persons_tmp'];
            //for saving start date and end date in a session for making reports
            $this->save_date($start_date,$end_date,'general');
           }
           
            
        }
        $data['method'] = 'general';
        $data['active'] = 'report';
        $data['page_name'] = 'admin/report';
        $this->load->view('main_template',$data);

    }
    public function monthly_report() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
          $data['month_value'] = $month = $_POST['month'];
          if($month <1 && $month > 12) {
              //month is wrong!
              $this->session->set_flashdata('status', 'ماه را اشتباه وارد کرده اید!');
              $this->session->set_flashdata('type', 'danger');
              redirect('report/');
          }
          //get current year 
          $now = $this->gregorian_to_jalali(date('Y'),date('m'),date('d'));
          $year_now = $now[0];//get the year for making queries

           //convert into gregory
           $start_date = $this->jalali_to_gregorian($year_now,$month,1);
           $end_date = $this->jalali_to_gregorian($year_now,$month,31);
           //change array to string format date (yyyy-mm-dd)
           $start_date = $this->to_string($start_date);
           $end_date = $this->to_string($end_date);
           //echo $start_date . '<br>' . $end_date ;die;//for test and debug
           $data['persons_tmp'] = $this->report_model->get_range_person($start_date,$end_date);
           
           //if the data is empty try not to send it!
           if(!empty($data['persons_tmp'])) {
            $data['persons'] = $data['persons_tmp'];
            //for saving start date and end date in a session for making reports
            $this->save_date($start_date,$end_date,'monthly');
           }
        }
        $data['method'] = 'monthly';
        $data['active'] = 'report';
        $data['page_name'] = 'admin/report';
        $this->load->view('main_template',$data);
        
    }
    public function yearly_report() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data['year_value'] = $year = (int)$_POST['year'];

            //wrong year input
            if($year < 1370 || $year > 1410) {
                $this->session->set_flashdata('status',"سال $year در دیتابیس موجود نمی باشد!");
                $this->session->set_flashdata('type', 'warning');
                redirect('report/');
            }

            //convert into gregory
           $start_date = $this->jalali_to_gregorian($year,1,1);
           $end_date = $this->jalali_to_gregorian($year,12,30);
           //change array to string format date (yyyy-mm-dd)
           $start_date = $this->to_string($start_date);
           $end_date = $this->to_string($end_date);
           //echo $start_date . '<br>' . $end_date ;die;//for test and debug
           $data['persons_tmp'] = $this->report_model->get_range_person($start_date,$end_date);
          
           //if the data is empty try not to send it!
           if(!empty($data['persons_tmp'])) {
            $data['persons'] = $data['persons_tmp'];
            //for saving start date and end date in a session for making reports
            $this->save_date($start_date,$end_date,'yearly');
           }
           

        }
        $data['method'] = 'yearly';
        $data['active'] = 'report';
        $data['page_name'] = 'admin/report';
        $this->load->view('main_template',$data);
        
    }

    public function download($method) {
        $this->load->helper('file');
        switch($method) {
            case 'general':
            $start_date = $_SESSION['start_date_general'];
            $end_date = $_SESSION['end_date_general'];

            $data['persons'] = $this->report_model->get_range_person($start_date,$end_date);
            //release RAM
            unset($_SESSION['start_date_general']);
            unset($_SESSION['end_date_general']);

            //write into csv file and download it
            $filename = 'گزارش عمومی مجرمین';
            $data = $data['persons'];
            //echo write_file(base_url().'assets/file.csv', $data);
            //$file = fopen(base_url().'assets/file.csv','w');
            //fwrite($file,$data);


            //print_r($data);
            //die;
            $this->write_csv($filename,$data);
            redirect('report/');
            break;
            // ***************************************************************************
            case 'monthly':
            echo $_SESSION['start_date_monthly'];die;
            break;
            // ***************************************************************************
            case 'yearly':
            echo $_SESSION['start_date_yearly'];die;
            break;
            // ***************************************************************************
            default: 
            $this->session->set_flashdata('status',"اطلاعاتی برای دانلود یافت نشد!");
            $this->session->set_flashdata('type', 'danger');
            redirect('report/');
        }
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
    //convert date array to string
    public function to_string($date) {
        return $date[0].'-'.$date[1].'-'.$date[2];
    }

    //saving start and end date for downloading reports
    public function save_date($start,$end,$mod) {
        $_SESSION['start_date_'.$mod] = $start;
        $_SESSION['end_date_'.$mod] = $end;
    }

    //write into csv file function

    public function write_csv($filename,$data) {

        $filename = 'Public_report_' . date('Ymd') . '.csv';
        header("Content-Description: File Transfer"); 
        header("Content-Encoding: UTF-8"); 
        header("Content-Disposition: attachment; filename=$filename"); 
        header("Content-Type: text/csv;charset=UTF-8");
        header("Content-Type: application/csv");
        echo "\xEF\xBB\xBF"; 
        // get data 
        // file creation 
        $file = fopen('php://output', 'w'); 
        $header = array('آی دی','نام','نام پدر','نام پدر کلان','جنسیت','به اساس','نوع واقعه','مکان','تاریخ','وکیل گذر','ولایت-دایم','ولسوالی-دایم','قریه-دایم','ولایت-موقت','ناحیه-موقت','گذر-موقت','نام کارمند مربوطه','نمبر کارمند مربوطه','نتیجه','اسم عکس','شماره تذکره');
        fputcsv($file, $header);
        foreach ($data as $key=>$line){ 
          fputcsv($file,$line); 
        }
        fclose($file); 
        exit; 
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

}







    