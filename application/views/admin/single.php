<div class="container">
      <div class="single">
    <?php if(isset($mojrem)):foreach($mojrem as $row):?>
        <div class="row">
        <!-- image section of mojrem -->
        <div class="col-lg-8 ">
          <div class="row">
            <h3>مشخصات شخصی</h3>
            <table class="table mojrem_info">
              <thead>
                <tr>
                  <th>نام</th>
                  <td style=""><?=$row['first_name']?></td>
                  <td style="">
                    <div class="col-lg-4 single_photo">
                       <a href="<?=base_url();?>assets/img/person_photos/<?=$row['person_image_name']?>.jpg" target="_blank"> <img style="position:absolute;left:50px;" src="<?=base_url();?>assets/img/person_photos/<?=$row['person_image_name']?>.jpg" alt="Person Photo" width='130' id="ph"></a>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th>نام پدر</th>
                  <td><?=$row['father_name']?></td>
                  <!-- <th>مکان واقعه</th>
                  <td>هرات</td> -->
                </tr>
                <tr>
                  <th>نام پدر کلان</th>
                  <td><?=$row['grand_father_name']?></td>
                  <!-- <th>تاریخ واقعه</th>
                  <td>1397</td> -->
                </tr>
                <tr>
                  <th>نمبر تذکره</th>
                  <td><?=$row['ssn']?></td>
                  <!-- <th>وکیل گذر مربوطه ناحیه</th>
                  <td>افضلی</td> -->
                </tr>
              </thead>
            </table>
            <h3>سکونت اصلی و فعلی</h3>
            <table class="table mojrem_info">
              <tr>
                <th>قریه</th>
                <td><?=$row['p_village']?></td>
                <th>گذر</th>
                <td><?=$row['t_gozar']?></td>
              </tr>
              <tr>
                <th>والسوالی</th>
                <td><?=$row['p_district']?></td>
                <th>ناحیه</th>
                <td><?=$row['t_nahiya']?></td>
              </tr>
              <tr>
                <th>ولایت</th>
                <td><?=$row['p_province']?></td>
                <th>ولایت</th>
                <td><?=$row['t_province']?></td>
              </tr>
            </table>
            <h3>شریدو وظیفوی کارمند مربوطه</h3>
            <table class="table mojrem_info">
              <tr>
                <th>نام کارمند</th>
                <td><?=$row['related_employee_name']?></td>
              </tr>
              <tr>
                <th>تخلص کارمند</th>
                <td></td>
              </tr>
              <tr>
                <th>شماره تماس</th>
                <td><?=$row['related_employee_number']?></td>
              </tr>
            </table>
            <h3>نتیجه واقعه</h3>
            <table class="table mojrem_info">
              <tr>
                <th>نتیجه واقعه</th>
                <td><?=$row['result']?></td>
              </tr>
              <tr>
                <th>به اساس</th>
                <td><?=$row['reason']?></td>
              </tr>
            </table>
          </div><!--end of row-->
        </div> <!--end of mojrem info-->
       
        </div><!--end of row-->

<?php endforeach;endif;?>
      </div> <!--end of div.single-->
    </div><!--end of container-->