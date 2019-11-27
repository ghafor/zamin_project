  <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>اضافه کردن مدیر جدید</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>admin/">خانه</a></li>
        <li class="active">مدیر جدید</li>
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
      <div class="row">
      <div class="col-lg-0"></div>
        <div class="col-lg-8">
            <form action="<?php echo base_url(); ?>admin/add_admin" method="post" enctype="multipart/form-data">
                      <table>
                        <tr>
                          <td>
                          <div class="form-group full col-lg-6">
                              <label for="first_name">نام</label>
                              <input type="text" name="first_name" placeholder="نام" required  value="<?php echo set_value('first_name'); ?>">
                            </div>
                          
                            <div class="form-group full col-lg-6">
                              <label for="last_name">نام خانوادگی</label>
                              <input type="text" name="last_name" placeholder="نام خانوادگی" required  value="<?php echo set_value('last_name'); ?>">
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="form-group full col-lg-6">
                              <label for="username">نام کاربری</label>
                              <input type="text" name="username" placeholder="نام کاربری" required  value="<?php echo set_value('username'); ?>">
                            </div>
                            
                            <div class="form-group full col-lg-6">
                              <label for="">رمز عبور</label>
                              <input type="password" name="password" placeholder="رمز عبور" required value="<?php echo set_value('password'); ?>">
                            </div>
                          </td>
                        </tr>

                        <tr>
                          <td>

                        <div class="form-group full col-lg-6">
                          <div class="radio">
                            <label>
                              <input type="radio" name="level" id="level1" value="1">
                              درجه اول
                            </label>
                          </div>

                          <div class="radio">
                            <label>
                              <input type="radio" name="level" id="level2" value="2">
                              درجه دوم
                            </label>
                          </div>
                        </div>
                    
                        <div class="form-group col-lg-6">
                          <label class="custom-file-upload">
                              <input type="file" id="file" onchange="run_show();" name="admin_photo"/>
                              <span id="priv"></span>
                              <i class="fa fa-cloud-upload" id="p_text">انتخاب عکس</i>
                          </label>
                        </div>
                             


                   
                          </td>
                        </tr>

                        <tr>
                            <td>
                            <div class="form-group full col-lg-12">
                      
                      <input type="submit" class="btn btn-primary btn-block" name="submit" value="اضافه کردن مدیر">
                    </div>
                            </td>
                        </tr>
                      </table>
                   
                    
                   
                    
                    
                    

                    

            </form>
        </div>
        
      
             
      </div><!--end of row-->
    </div><!--end of container-->
  </div><!--end of content-->



  
  <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script>
$(document).ready(function(){
 function show(input) {
    if(input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload  = function(e) {
        $('#priv').html("<img src='"+e.target.result+"' width='140' style='margin-bottom:100px;'>");
      }
      reader.readAsDataURL(input.files[0]);

    }
 }
 $('#file').change(function(){
    show(this);
    $('#p_text').hide();
 });
});

</script>


