<div class="content-header">
    <h1>پروفایل مدیر</h1>
</div>
<div class="container-fluid content" >
    <div class="container">
        <?php if(isset($_SESSION['status'])):?>
            <div class="box text-center">
                    <p class="alert alert-<?=$_SESSION['type']?>"><?=$_SESSION['status']?></p>
            </div>
        <?php endif;?>
            <div class="row">
            <form onchange="form_changed()" method="post" action="<?php echo base_url();?>admin/profile" enctype="multipart/form-data">

                <div class="col-lg-4 col-md-4 col-sm-4 change_profile_section">
                        <?php if(isset($admin_info)): foreach($admin_info as $row):?>
                        <div class="form-group">
                            <label for="email">نام</label>
                            <input type="text" class="form-control" id="email" name="first_name" value="<?=$row['first_name'];?>">
                        </div>
                        <div class="form-group">
                            <label for="lastname">تخلص</label>
                            <input type="text" class="form-control" id="lastname" name="last_name" value="<?=$row['last_name'];?>">
                        </div>
                        <div class="form-group">
                            <label for="username">نام کاربری(انگلیسی باشد)</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?=$row['username'];?>">
                        </div>


                        <div class="form-group">
                            <label for="password">رمزعبور (تغییر رمز دلخواه است)</label>
                            <!-- <input  name="password" id="password1" type="password" class="form-control"> -->
                            <input type="password" class="form-control" id="password1" name="password" value="">
                        </div>

                      


                        <div class="form-group">
                            <label for="password" id="conf">تکرار رمز عبور</label>
                            <input type="password" class="form-control" id="password2" onkeyup="check_conf();" name="confirm_password" value="">
                            <!-- <input  name="confirm_password" id="password2" type="password" class="form-control"  onkeyup="check_conf();"> -->

                        </div>
                    <?php endforeach;endif;?>
                </div>

                <div class="col-lg-5 col-md-5 col-sm-5 photo_profile ">
                    <div>
                    <a href="<?=base_url();?>assets/img/admin_photos/<?=$_SESSION['image_name'];?>.jpg" target="_blank">
                        <img class="img-thumbnail img-responsive profile_photo" src="<?=base_url();?>assets/img/admin_photos/<?=$_SESSION['image_name'];?>.jpg" alt="profile photo" width="200">
                    </a>
                    <div class="form-group">
                    
                        <label class="btn_change_photo btn btn-primary" id="myfile" style="margin-right:30px;margin-top:10px;" >
                        <input type="file" name="admin_photo"  onchange="do_change();form_changed();">
                        انتخاب عکس جدید
                        </label>
                        <span id="myfile1" style="margin-top:10px;">
                            
                        </span>
                    </div>
                </div>
                
                    
                </div><!--end of photo_profile-->
                <div class="col-lg-10">
                <div class="form-group">
                </div>
                    <button type="submit" id="submit_btn" class="btn btn-block btn-primary btn_save_changes" style="display:none;">ذخیره تغییرات</button>
                </div>

                </form>
            </div><!--end of row-->
            
        
    </div><!--end of container-->
</div>

<script>
    //if the input type file changes do the changes
    function do_change() {
        document.getElementById('myfile1').innerHTML = "عکس انتخاب شد!";
    }
    //if form changed make the submit button allow to post
    function form_changed() {
        document.getElementById('submit_btn').style.display = 'block';
    // alert(2);
    }
    function check_conf() {
        let val1 = document.getElementById('password1').value;
        let val2 = document.getElementById('password2').value;
        //alert('val1:'+val1+' val2:'+val2);
        if(val1 != val2) {
            document.getElementById('conf').style.color = 'red';
        }else {
            document.getElementById('conf').style.color = 'green';
        }
    }
</script>