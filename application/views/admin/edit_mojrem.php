  <!-- Content Wrapper. Contains page content -->
  <div class="">
  <script src="<?php echo base_url();?>assets/js/kamadatepicker.js"></script>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>اضافه کردن مجرم جدید</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>admin/">خانه</a></li>
        <li class="active">ویرایش اطلاعات</li>
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
          <!-- personal information  -->

          <form action="<?=base_url()?>admin/add_mojrem" method="post" enctype="multipart/form-data">
          <?php if(isset($mojrem)): foreach($mojrem as $row):?>
          <fieldset>
            <legend>مشخصات شخصی</legend>
            <div class="row">
              <div class="col-lg-10">
                <div class="row">
                  <!-- firstname input -->
                 <?php if(isset($_SESSION['data'])) {
                   $data = $_SESSION['data'];
                //   print_r($data);
                 }?>
                  <div class="col-lg-6">
                    <div class="form-group full">
                      <label for="">نام</label>
                      <input type="text" name="first_name" placeholder="نام مجرم" value="<?=$row['first_name']?>">
                    </div>
                  </div>
                  <!-- father name input -->
                  <div class="col-lg-6">
                    <div class="form-group full">
                      <label for="">نام پدر</label>
                      <input type="text" name="father_name" placeholder="نام پدر مجرم" value="<?=$row['father_name']?>">
                    </div>
                  </div>
                  <!-- grand father name -->
                  <div class="col-lg-6">
                    <div class="form-group full">
                      <label for="">نام پدر کلان</label>
                      <input type="text" name="grand_name" placeholder="نام پدرکلان مجرم" value="<?=$row['grand_father_name']?>">
                    </div>
                  </div>
                  <!-- ssn number input -->
                  <div class="col-lg-6">
                    <div class="form-group full">
                      <label for="">نمبر تذکره</label>
                      <input type="text" name="ssn" placeholder="نمبرتذکره مجرم" value="<?=$row['ssn']?>">
                    </div>
                  </div>
                </div><!--end of row inner  t the col-lg-6-->         
              </div><!--end of col-lg-10 -->
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
              <!-- mojrem photo input -->
              <div class="col-lg-2">
                <div class="form-group">
                  <label class="custom-file-upload">
                      <input type="file" id="file" onchange="run_show();" name="mojrem_photo"/>
                      <span id="priv"><img src="<?=base_url();?>assets/img/person_photos/<?=$row['person_image_name']?>.jpg" alt="person photo"  width='140' style='margin-bottom:100px;'></span>
                      <i class="fa fa-cloud-upload" id="p_text">انتخاب عکس<br>( حداکثر 5MB)</i>
                     
                  </label>
                </div>
               
              </div>
            </div>
          </fieldset>
          
         
          <!-- Information about event -->
          <fieldset class="event">
            <legend> مشخصات مربوطه واقعه</legend>
            <div class="row">
              <!-- event type input  -->
              <div class="col-lg-6">
                <div class="form-group full">
                  <label for="">نو ع واقعه</label>
                  <input type="text" name="event_type" placeholder="نوع واقعه" value="<?=$row['event_type']?>">
                </div>
              </div>
              <!-- event place inout -->
              <div class="col-lg-6">
                <div class="form-group full">
                  <label for="">مکان واقعه</label>
                  <input type="text" name="event_place" placeholder="مکان واقعه" value="<?=$row['place']?>">
                </div>
              </div>
              <!-- event date input  -->
              <div class="col-lg-6">
                <div class="form-group full">
                  <label for="">تاریخ واقعه</label>
                  <!-- <input type="date" name="evet_date" placeholder="تاریخ واقعه"> -->
                  <input type="text" id="test-date-id" name="date" placeholder="تاریخ واقعه" value="<?=$row['date']?>">
                </div>
              </div>
              <script>
                //kamaDatepicker('test-date-id');
                kamaDatepicker('test-date-id', { buttonsColor: "blue", forceFarsiDigits: true,markToday:true,gotoToday:true,twodigit:false});
              </script>
               <!-- vakil input   -->
              <div class="col-lg-6">
                <div class="form-group full">
                  <label for="">وکیل گذر مربوطه ناحیه</label>
                  <input type="text" name="wakil" placeholder="وکیل گذر مربوطه ناحیه " value="<?=$row['wakil']?>">
                </div>
              </div>
            </div>
          </fieldset>
          <!-- end of  information about event  -->
          <!-- information aboout main place -->
          <fieldset class="event">
            <legend>مشخصات محل سکونت</legend>
            <caption>سکونت اصلی</caption>
            <div class="row">
              <!-- village input  -->
              <div class="col-lg-4">
                <div class="form-group full">
                  <label for="">قریه</label>
                  <input type="text" name="p_village" placeholder="قریه" value="<?=$row['p_village']?>">
                </div>
              </div>
              <!-- walesali input -->
              <div class="col-lg-4">
                <div class="form-group full">
                  <label for="">والسوالی</label>
                  <input type="text" name="p_district" placeholder="والسوالی" value="<?=$row['p_district']?>">
                </div>
              </div>
              <!-- province input -->
              <div class="col-lg-4">
                <div class="form-group full">
                  <label for="">ولایت</label>
                  <input type="text" name="p_province" placeholder="ولایت" value="<?=$row['p_province']?>">
                </div>
              </div>  
            </div>
          </fieldset>
          <!-- end of main place  -->

          <!-- start the previous place -->
          <fieldset class="event">
            <caption>سکونت فعلی</caption>
            <div class="row">
              <!-- kozar input -->
              <div class="col-lg-4">
                <div class="form-group full">
                  <label for="">گذر</label>
                  <input type="text" name="t_gozar" placeholder="گذز" value="<?=$row['t_gozar']?>">
                </div>
              </div>
              <!-- area input -->
              <div class="col-lg-4">
                <div class="form-group full">
                  <label for="">ناحیه</label>
                  <input type="text" name="t_nahiya" placeholder="ناحیه" value="<?=$row['t_nahiya']?>" >
                </div>
              </div>
              <!-- province input  -->
              <div class="col-lg-4">
                <div class="form-group full">
                  <label for="">ولایت</label>
                  <input type="text" name="t_province" placeholder="ولایت" value="<?=$row['t_province']?>">
                </div>
              </div>
            </div>
          </fieldset>
          <!-- end of  Previous place section   -->
          <fieldset class="event">
            <legend>شریدو وظیفوی کارمند مربوطه</legend>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group full">
                  <label for="">نام کارمند</label>
                  <input type="text" name="em_name" placeholder="نام کارمند" value="<?=$row['related_employee_name']?>">
                </div>
              </div>
              
              <div class="col-lg-6">
                <div class="form-group full">
                  <label for="">شماره تماس</label>
                  <input type="text" name="em_phone" placeholder="شماره تماس" value="<?=$row['related_employee_number']?>">
                </div>
              </div>
            </div>
          </fieldset>
          <!-- end of previous place section  -->
          <!-- start the result section  -->
          <fieldset class="event">
            <legend>نتیجه واقعه</legend>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group full">
                  <label for="">نتیجه</label>
                  <input type="text" name="result" placeholder="نتیجه" value="<?=$row['result']?>">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group full">
                  <label for="">به اساس</label>
                  <input type="text" name="base" placeholder="به اساس" value="<?=$row['reason']?>">
                </div>
              </div>
            </div>
          </fieldset>
          <!-- end of result section  -->
          <!-- file uploder -->
          <br>
          
           <div class="form-group">
             <input type="submit" value="ثبت اطلاعات" class="btn btn-primary btn-block" name="submit">
           </div>
        </div><!--end of col-lg-12 -->
<?php endforeach;endif;?>
        </form>
      </div><!--end of row-->
    </div><!--end of container-->
  </div><!--end of content-->
 