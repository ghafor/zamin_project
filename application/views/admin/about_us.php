<?php if(isset($_SESSION['lang']) && $_SESSION['lang'] != '') {
  $this->lang->load('main',$_SESSION['lang']);
}else {
  $this->lang->load('main','persian');
}?>
  <!-- Content Wrapper. Contains page content -->
<div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <?=$this->lang->line(' در مورد ما');?>
     </h1>
      <h4>
      <?=$this->lang->line('معرفی سازنده ');?> </h4>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>admin/"> <?=$this->lang->line('خانه');?></a></li>
      </ol>
    </section>
  
    <div class="content">
        <div class="row">
        <div class="col-lg-4"></div>
            <div class="col-lg-4">
                 <img src="<?php echo base_url();?>assets/img/about_us/1.jpg" class="img-thumbnail img-responsive img-circle" alt="Cinque Terre">
                <div align="center" style="margin-left:50px;">
                    <h3>
                    <?=$this->lang->line('ضامن علی (حسینی)');?>  
                    </h3>
                    <h5>
                    <?=$this->lang->line('برنامه نویسی توسعه دهنده وب');?>
                    </h5>
                    <p>
                    <?=$this->lang->line('دانشجوی سال چهارم رشته کمپیوتر ساینس، و متخصص توسعه نرم افزار های تحت وب.');?>
                    </p>
                </div>
            </div>
            
            <div class="col-lg-4"></div>

            <br><br>
            <br><br>
            <br>
            <div class="row container-fluid ">
            <br>
                <div class="col-lg-4"></div>
               
                <div class="col-lg-4"></div>
            </div>
        </div>
    </div>
        
</div>
