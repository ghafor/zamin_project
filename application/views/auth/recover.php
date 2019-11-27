<?php $this->load->view('inc/header.php'); ?>

<body class="hold-transition login-page" id="login_body" style="background:url('<?php echo base_url();?>assets/img/background/home_bg.jpg') no-repeat 100% center">
<div class="login-box">
  <div class="login-logo">
    <a href="#" id="login_title"><b>ورود به صفحه بازیابی</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body" style="box-shadow:0px 2px 20px 1px black">
    <p class="login-box-msg">فرم زیر را برای بازیابی تکمیل کنید</p>
    <?php if(isset($pin_err)): ?>
   <p class="login_err alert alert-danger" style="text-align:center;"><?= $pin_err; ?></p>
<?php endif;?>
   <br>
   <br>
   
    <form action="<?php echo base_url();?>auth/recovery" method="post" autocomplete="off">
    
      <div class="form-group has-feedback" id="user_id">
      
        <input name="username" id="username" type="text" class="form-control" placeholder="نام کاربری" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      
   
      <div class="form-group has-feedback" id="pin_id">
        <input  name="pin" id="pin" type="password" class="form-control" placeholder="لطفا پین کد تان را وارد کنید" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" id="login_btn" class="btn btn-primary btn-block btn-flat">بازیابی رمز عبور</button>
        </div>
        <!-- /.col -->
        
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<?php $this->load->view('inc/footer.php'); ?>
