  <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>آپلود دوسیه های مجرم</h1>
      <ol class="breadcrumb">
        <li><a href="#">خانه</a></li>
        <li class="active">آپلود دوسیه ها</li>
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
        <div class="col-lg-10">
        <form action="<?=base_url();?>admin/add_document" method="post" enctype="multipart/form-data">
             <div class="form-group">
            <br>
              <label for="test" id="uploads" class="btn btn-primary">آپلود اسناد <i class="fa fa-cloud-upload" id="p_text"></i></label>
              <input type="file" id="test" onchange="do_change();" multiple name="documnets[]"> 
              <a href="<?=base_url()?>admin/list_mojrem" class="btn btn-danger pull-left">دوسیه ندارد</a>
              <p class="help-block">
                <ul>
                    <li>پسوند اسناد را <span style="color:red;">jpg</span> وارد کنید</li>
                    <li>حجم هر سند باید کمتر از <span style="color:red;">5 MB </span> باشد</li>
                    <li>اگر مجرم دوسیه دارد بالای گزینه آپلود کلیک کنید</li>
                    <li>در صورتی که چندین دوسیه دارد دوسیه هارا همزمان انتخاب کنید</li>
                    <li>درصورت عمدم وجود دوسیه میتوانید گزینه دوسیه ندارد را انتخاب کنید.</li>
                </ul>
              </p>
            </div>
            <input type="hidden" name="id" value="<?=$id?>">
            
           <br><br>
           <div class="form-group">
             <input type="submit" value="ثبت اطلاعات" class="btn btn-primary btn-block" name="submit">
           </div>
        </form>

        </div>
    </div>
</div>

<script>
  function do_change() {
    document.getElementById('uploads').innerHTML = 'اسناد انتخاب شد';
  }
</script>
