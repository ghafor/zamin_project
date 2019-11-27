  <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>اضافه کردن وسیله جدید</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>admin/car">خانه</a></li>
        <li class="active">وسیله جدید</li>
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
            <div class="container">
            delete
            </div>