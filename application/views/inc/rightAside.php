<?php if(isset($_SESSION['lang']) && $_SESSION['lang'] != '') {
  $this->lang->load('main',$_SESSION['lang']);
}else {
  $this->lang->load('main','persian');
}?>

<aside class="main-sidebar">

<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">

  <!-- Sidebar user panel (optional) -->
  <div class="user-panel">
    <div class="pull-right image">
      <img src="<?php echo base_url();?>assets/img/admin_photos/<?php echo $_SESSION['image_name'];?>.jpg" class="img-circle" alt="User Image">
    </div>
    <div class="pull-right info">
      <p><?php echo $this->session->first_name . ' '. $this->session->last_name;?></p>
      <!-- Status -->
      <a href="<?=base_url();?>admin/profile"><i class="fa fa-circle text-success"></i><?=$this->lang->line('آنلاین');?></a>
    </div>
  </div>



  <!-- Sidebar Menu -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header"><?=$this->lang->line('عنوان');?> </li>
    <!-- Optionally, you can add icons to the links -->
   
    <li  class="<?php if($active == 'dashboard') echo 'active';?>"><a href="<?php echo base_url();?>admin/"><i class="fa fa-dashboard"></i> <span><?=$this->lang->line('داشبورد');?></span></a></li>
   
    <li class="treeview">
      <a href="#"><i class="fa fa-user "></i> <span><?=$this->lang->line('مدیریت وسایط');?></span>
        <span class="pull-left-container">
            <i class="fa fa-angle-left pull-left"></i>
          </span>
      </a>
      <ul class="treeview-menu">
      <li class="<?php if($active == 'add_vehicle') echo 'active';?>"><a href="<?php echo base_url();?>vehicle/add_vehicle"><a href="<?php echo base_url();?>vehicle/add_vehicle"><i class="fa fa-plus"></i> <span><?=$this->lang->line('ثبت وسیله');?> </a></li>
        <li class="<?php if($active == 'list_vehicle') echo 'active';?>"><a href="<?php echo base_url(); ?>vehicle/list_vehicle"><a href="<?php echo base_url();?>vehicle/list_vehicle"><i class="fa fa-list"></i> <span><?=$this->lang->line('لیست وسیله ها');?> </a></li>
      </ul>
    </li>


    <li class="treeview">
      <a href="#"><i class="fa fa-user "></i> <span><?=$this->lang->line('مدیران');?></span>
        <span class="pull-left-container">
            <i class="fa fa-angle-left pull-left"></i>
          </span>
      </a>
      <ul class="treeview-menu">
      <?php if($_SESSION['add_admin'] == '1'):?>
      <li class="<?php if($active == 'add_admin') echo 'active';?>"><a href="<?php echo base_url();?>admin/add_admin"><i class="fa fa-plus"></i> <span><?=$this->lang->line('اضافه کردن مدیر');?>  </span></a></li>
<?php endif;?>
      <li class="<?php if($active == 'admin') echo 'active';?>"><a href="<?php echo base_url();?>admin/admins"><i class="fa fa-list"></i> <span><?=$this->lang->line(' لیست مدیران');?> </span></a></li>


      </ul>
    </li>

    <li class="<?php if($active == 'report') echo 'active';?>">
    <a href="<?php echo base_url(); ?>report/"><i class="fa fa-print"></i> <span><?=$this->lang->line('گزارشات');?></span></a></li>
    <li class="<?php if($active == 'setting') echo 'active';?>"><a href="<?php echo base_url(); ?>setting/"><i class="fa fa-gears"></i> <span><?=$this->lang->line('تنظیمات');?></span></a></li>
    <li class="<?php if($active == 'about_us') echo 'active';?>"><a href="<?php echo base_url(); ?>admin/about_us"><i class="fa fa-phone"></i> <span><?=$this->lang->line('در باره ما');?> </span></a></li>
    <li class=""><a href="<?php echo base_url(); ?>auth/logout"><i class="fa fa-sign-out"></i> <span> <?=$this->lang->line('خروج از سیستم');?> </span></a></li>
  </ul>
  <!-- /.sidebar-menu -->
  
</section>
<!-- /.sidebar -->
</aside>