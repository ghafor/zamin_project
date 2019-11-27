<?php $this->load->view('inc/header.php'); ?>

<body class="hold-transition login-page" id="login_body" style="background:url('<?php echo base_url();?>assets/img/background/home_bg.jpg') no-repeat 100% center">


 


<div class="login-box">
  <div class="login-logo">
    <a href="#" id="login_title"><b>تغییر رمز عبور</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">فرم تغییر رمز عبور</p>
    <?php if(isset($cp_err)): ?>
   <p class="login_err alert alert-danger" style="text-align:center;"><?=$cp_err; ?></p>
<?php endif;?>
   <br>
   <br>
   
    <form action="<?php echo base_url();?>auth/change_password" method="post" autocomplete="off">
    
     
    <div class="row">
      <div class="form-group has-feedback" id="pin_id">
        <input  name="password" id="pin" type="password" class="form-control" placeholder="رمز عبور" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div></div>
      <div class="row">

      <div class="form-group has-feedback" id="pin_id">
        <input  name="confirm_password" id="pin" type="password" class="form-control" placeholder="تکرار رمز عبور" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" id="login_btn" class="btn btn-primary btn-block btn-flat">تغییر رمز</button>
        </div>
        <!-- /.col -->
         
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<?php $this->load->view('inc/footer.php'); ?>
