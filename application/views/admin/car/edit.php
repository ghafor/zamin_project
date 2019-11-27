  <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>تنظیم  کردن وسیله </h1>
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
            <form action="<?=base_url()?>vehicle/edit" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-4">
                    <input type="hidden" name="id_field" value="<?php echo $post->id?>">
                        <div class="form-group full">
                            <label for="">نام</label>
                            <input type="text" name="name" placeholder=" نام وارید کنید" value="<?php echo $post->name?>">
                        </div>
                        
                        <div class="form-group full">
                              <label for="">مودل</label>
                              <input type="text" name="model" placeholder="مودل وارید کنید " value="<?php echo $post->model?>">
                        </div> 
                        
                        <div class="form-group full">
                              <label for="">پلت</label>
                              <input type="text" name="plate" placeholder="پلت را وارید کنید " value="<?php echo $post->plate?>">
                        </div>

                  </div>


                   <div class="col-lg-4">
                       <label class="control-label" for="selectError">Category</label><br>
                            <select name="category" class="demoInputBox">
                              <option value="car">Car</option>
                              <option value="motor">Motor</option>
                              <option value="bycilce">Bycilce</option>
                              <option value="truck">Truck</option>
                            </select>
                    </div>
               
                
                    <div class="col-lg-4">
                    <?php //echo form_open_multipart('upload/do_upload');?>

                          <label class="custom-file-upload">
                              <input type="file" id="file" onchange="run_show();" name="car_photo" />
                              <span id="priv"></span>
                              <i class="fa fa-cloud-upload" id="p_text">انتخاب عکس</i>
                          </label>
                      

                    </div>
                    <div class="form-group full col-lg-12">   
                          <input type="submit" class="btn btn-primary btn-block" name="submit" value="اضافه کردن موتر">
                     </div>

                </div>
                </form>
            </div>
           