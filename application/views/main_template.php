<?php $this->load->view('inc/header'); ?>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">
    <!-- Logo -->
    <a href="<?=base_url();?>admin/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">پنل</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>صفحه مدیریت</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>


     <?php if($page_name == 'admin/single'):?>
     <script>
      function print_me() {
        window.print();
      }
     </script>

      <a href="#" onclick="print_me();" class="btn hidden-xs" style="margin:6px 100px;padding:9px 50px;background-color:#d61577;border-color:#ad0b5d;font-weight:bold;color:#FFF">چاپ نتیجه</a>
    <?php endif;?>
    <?php if(isset($documents)): if($documents != null && $page_name == 'admin/single'):isset($mojrem) ?$id = $mojrem[0]['id']:$id='';?>
    <a href="<?=base_url();?>admin/view_docs/<?=$id?>" class="btn hidden-xs" style="margin:6px 100px;padding:9px 50px;background-color:#d61577;border-color:#ad0b5d;font-weight:bold;color:#FFF">دیدن اسناد</a>

    <?php endif;endif;?>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li>
                      <div class="dropdown" style="margin-top:10px;">
              <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">زبان
              <span class="caret"></span></button>
              <ul class="dropdown-menu">
                <li><a href="<?=base_url();?>auth/change_language/persian">دری</a></li>
                <li><a href="<?=base_url();?>auth/change_language/pashto">پشتو</a></li>
              </ul>
            </div>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url();?>assets/img/admin_photos/<?php echo $_SESSION['image_name'];?>.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->session->first_name . ' '. $this->session->last_name;?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url();?>assets/img/admin_photos/<?php echo $_SESSION['image_name'];?>.jpg" class="img-circle" alt="User Image">

                <p>
                <?php echo $this->session->first_name . ' '. $this->session->last_name;?>
                  <small>مدیریت کل دیتابیس</small>
                </p>
              </li>
              <!-- Menu Body -->
             
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?=base_url();?>admin/profile" class="btn btn-default btn-flat">پروفایل</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url();?>auth/logout" class="btn btn-default btn-flat">خروج</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
         
        </ul>
      </div>
    </nav>
  </header>



  <!-- right side column. contains the logo and sidebar -->
<?php $this->load->view('inc/rightAside'); ?>
  <!-- Content Wrapper. Contains page content -->




  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   



<?php $this->load->view("$page_name"); ?>
      <!--------------------------
        | Your Page Content Here |
        -------------------------->
<!-- ********************************************************************************* -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer text-left">
    <strong>Copyright &copy; 2019- <?php echo date('Y');?> <a href="http://www.facebook.com/zaminali hussaini">Zamin _Ali Hussaini</a></strong>
  </footer>



</div>
<?php $this->load->view('inc/footer');?>