<?php if(isset($_SESSION['lang']) && $_SESSION['lang'] != '') {
  $this->lang->load('main',$_SESSION['lang']);
}else {
  $this->lang->load('main','persian');
}?>  
  <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?=$this->lang->line('اضافه کردن وسیله جدید');?> </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>admin/">
        <?=$this->lang->line('خانه');?></a></li>
        <li class="active">
        <?=$this->lang->line('وسیله جدید');?>
      </li>
      </ol>
    </section>

    <!-- start the form the add the mojrem info-->
    <div class="container">
      <div class="row main-content">
   
      <?php if(isset($_SESSION['status'])):?>
            <div class="box text-center">
            <p class="alert alert-<?=$_SESSION['type']?>"><?=$_SESSION['status']?></p>
            </div>
            <?php endif;?>


           <!-- <div class="container">-->
           
                <div class="row">
                  <!-- this  is loading-->
                  <div class="col-lg-0"></div>
                <div class="col-lg-6"  style="margin-right:10px;">  
                <?php if(isset($errors)):?>
                <p class='alert alert-danger'>
                <?php  echo $errors;?>
                </p>
<?php endif;?>
                <form action="<?=base_url()?>vehicle/add_vehicle" method="post" enctype="multipart/form-data">
                
                   <div class='row'>         
                       
                         
                          <div class="form-group full col-lg-6">
                            <label for="">   <?=$this->lang->line('نام ');?></label>
                            <input type="text" name="name" placeholder="   <?=$this->lang->line('نام خود را وارید کنید');?>" value="<?php if(isset($data['name'])) echo $data['name'];?>">
                        </div>
                         
                          <div class="form-group full col-lg-6">
                              <label for=""><?=$this->lang->line('مودل');?></label>
                              <input type="text" name="model" placeholder="   <?=$this->lang->line('مودل خود را وارید کنید');?>" value="<?php if(isset($data['model'])) echo $data['model'];?>">
                        </div>
                     
                          <div class="form-group full col-lg-6"> 
                              <label for=""><?=$this->lang->line('پلت ');?></label>
                              <input type="text" name="plate" placeholder="   <?=$this->lang->line(' پلت خود را وارید کنید');?>" value="<?php if(isset($data['plate'])) echo $data['plate'];?>">
                        </div>
                    
                          <div class="form-group full col-lg-6">
                       <label class="control-label" for="selectError">
                       <?=$this->lang->line('انواع وسایط');?> </label><br>
                            <select name="category" class="demoInputBox form-control">
                              <option value="car">
                              <?=$this->lang->line('موتر');?></option>
                              <option value="motor"> <?=$this->lang->line('موتور');?></option>
                              <option value="bycilce"> <?=$this->lang->line('بایسکیل');?></option>
                              <option value="truck"> <?=$this->lang->line('موتر بار');?></option>
                            </select>
                    </div>
               
                
                    
                          <div class="form-group full col-lg-6">
                    <?php //echo form_open_multipart('upload/do_upload');?>


                          <label class="custom-file-upload">
                              <input type="file" id="file" onchange="run_show();" name="car_photo"/>
                              <span id="priv"></span>
                              <i class="fa fa-cloud-upload" id="p_text">  <?=$this->lang->line('انتخاب عکس');?></i>
                          </label>
                      

                    </div>
                  
                          <div class="form-group full col-lg-12"> 
                          <input type="submit" class="btn btn-primary btn-block" name="submit" value="<?=$this->lang->line('اضافه کردن موتر');?>">
                     </div>
                  </div>
                </table>
                </form>
              </div>
            </div>

           
           