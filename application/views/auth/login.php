<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ورود به صحفحه مدیریت</title>

   <!-- Bootstrap 3.3.7 -->
   <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/bootstrap-theme.css">
  <!-- Bootstrap rtl -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/rtl.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
  <!-- Font Awesome -->
  <!-- Ionicons -->
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>


<body class="hold-transition login-page" id="login_body">
<div class="login-box">
  <div class="login-logo">
    <a href="#" id="login_title"><b>ورود به صفحه مدیریت</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">فرم زیر را تکمیل کنید و ورود بزنید</p>
    <?php if(isset($login_err)): ?>
   <p class="login_err alert alert-danger" style="text-align:center;"><?= $login_err; ?></p>
<?php endif;?>
   <br>
   <br>
   
    <form action="<?php echo base_url();?>auth/login" method="post" autocomplete="off">
    
      <div class="form-group has-feedback" id="user_id">
      
        <input name="username" id="username" type="text" class="form-control" placeholder="نام کاربری" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback" id='pass_id'>
        <input  name="password" id="password" type="password" class="form-control" placeholder="رمز عبور" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback" id="pin_id" style="display:none">
        <input  name="pin" id="pin" type="password" class="form-control" placeholder="لطفا پین کد تان را وارد کنید">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      
      <div class="row">
          <div class="col-xs-12">
          <input type="submit" class="btn bg-aqua btn-block btn-flat" value="ورود">
          </div>
      </div>

    </form>
    <div class="row">
          <div class="col-xs-12">
          <a href="<?php echo base_url();?>auth/recovery" class="btn bg-aqua btn-block btn-flat" id="recover" style="margin-top:5px;">رمز عبور خود را فراموش کرده ام</a>
          </div>
      </div>
   
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<?php $this->load->view('inc/footer.php'); ?>

<script>
//login via jquery
$(document).ready(function(){
  $('form').submit(function(e){
    
    $('#login_btn').attr('disabled','disabled');
    $('#spinner').css('display','block');
    let u = $('#username').value();
    let p = $('#password').value();
    
    e.preventDefault();
    $.post("<?php echo base_url();?>auth/login",
    {
        username: u,
        password: p
    },
    function(data, status){
        alert("Data: " + data + "\nStatus: " + status);
    });
  });
 
});
</script>