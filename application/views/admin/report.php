
  <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>صفحه گزارشات</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>admin/"> خانه</a></li>
        <li class="active">راپور</li>
      </ol>
    </section>
    <!-- report section -->
    <div class="report">
      <div class="panel-group" id="accordion">
        <div class="panel panel-default">
        <?php if(isset($_SESSION['status'])):?>
            <div class="box text-center">
            <p class="alert alert-<?=$_SESSION['type']?>"><?=$_SESSION['status']?></p>
            </div>
      <?php endif;?>
          <div class="panel-heading">
          
    
            <h4 class="panel-title"><a data-toggle="collapse" class="btn btn-primary" style="color:white;" data-parent="#accordion" href="#">گزارش عمومی</a></h4>
            <h4 class="panel-title"><a data-toggle="collapse" class="btn btn-primary" style="color:white;" data-parent="#accordion" href="#">گزارش ماهوار</a></h4>
            <h4 class="panel-title"> <a data-toggle="collapse" class="btn btn-primary" style="color:white;" data-parent="#accordion" href="#">گزارش سالانه</a></h4>
            <div class="pull-left">
            <?php if(isset($persons)):?>
              <a  class="btn btn-primary" style="color:white; display:none" href="<?php echo base_url();?>admin/" >چاپ نتیجه</a>
              <a  class="btn btn-primary" style="color:white;"  href="<?php echo base_url();?>report/download/<?php if(isset($method))echo $method;else echo 'nothing';?>">دانلود نتیجه</a>
            <?php endif;?>  
          </div>
          </div>
          <?php
          //try to keep collapses open after query execution
          $c1 = $c2 = $c3 = '';
          if(isset($method)) {
            switch($method) {
              case 'general':$c1 = 'in';break;
              case 'monthly':$c2 = 'in';break;
              case 'yearly':$c3 = 'in';break;
            }
          }else {
            $c1 = 'in';
          }
            ?>
          
          <div id="collapse1" class="panel-collapse collapse <?=$c1?>">
            <div class="panel-body">
           
              <div class="general_report">
              <form action="<?php echo base_url();?>report/general_report" method="post" autocomplete="off">
                <input type="text" id="t1" style="float:right; margin-left:10px;" name="start_date" value="<?php if(isset($start_general_value))echo $start_general_value; ?>" placeholder="روز/ ماه/ سال" cols="13" required>
                
                <input type="text" id="t2" style="float:right; margin-left:10px;" name="end_date" value="<?php if(isset($end_general_value))echo $end_general_value; ?>" placeholder="روز/ ماه/ سال" required>
                <input type="submit" class="btn btn-primary" name="take_report" value="گرفتن گزارش">
              
                  <span class="alert alert-default">
                    تاریخ را به شکل   1398/10/27   وارد کنید
                  </span>
                  </form>
                  <!-- making the date validate -->
                  <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>

                  <script src="<?php echo base_url();?>assets/js/kamadatepicker.js"></script>


                  <script>
                //kamaDatepicker('test-date-id');
                    kamaDatepicker('t1', { buttonsColor: "blue", forceFarsiDigits: true,markToday:true,gotoToday:true});
                    kamaDatepicker('t2', { buttonsColor: "blue", forceFarsiDigits: true,markToday:true,gotoToday:true});
                 </script>

                <script>
                  $(document).ready(function(){
                    $('#general_start_date').change(function(){
                      //alert(2);
                      if(!check_date('general_start_date')) {
                        alert('تاریخ را اشتباه وارد نموده اید!');
                        $(this).val('');
                      }
                    });

                    $('#general_end_date').change(function(){
                      if(!check_date('general_end_date')) {
                        alert('تاریخ را اشتباه وارد نموده اید!');
                        $(this).val('');
                      }
                    });


                    function check_date(id) {
                      let start_date = $('#'+id).val();
                      let arr = start_date.split('/');
                      if(arr.length == 3) {
                        if(arr[0].length != 4 || arr[1].length >2 || arr[2].length >2) {
                        return false;
                        }else {
                          return true;
                        }
                        }else {
                          return false;
                        }
                      }

                  
                    
                    
                  });
                </script>
              </div>
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div id="collapse2" class="panel-collapse collapse <?=$c2?>">
            <div class="panel-body">
              <div class="monthly_report dropdown">
              <form action="<?php echo base_url();?>report/monthly_report" method="post">
                <select name="month" class="btn btn-primary dropdown-toggle btn-sm" required>
                  <option value="0" >ماه مورد نظرتان را انتخاب کنید </option>
                  <option value="1" <?php if(isset($month_value)){if($month_value==1)echo 'selected';}  ?>>حمل</option>
                  <option value="2" <?php if(isset($month_value)){if($month_value==2)echo 'selected';}  ?>>ثور</option>
                  <option value="3" <?php if(isset($month_value)){if($month_value==3)echo 'selected';}  ?>>جوزا</option>
                  <option value="4" <?php if(isset($month_value)){if($month_value==4)echo 'selected';}  ?>>سرطان</option>
                  <option value="5" <?php if(isset($month_value)){if($month_value==5)echo 'selected';}  ?>>اسد</option>
                  <option value="6" <?php if(isset($month_value)){if($month_value==6)echo 'selected';}  ?>>سنبله</option>
                  <option value="7" <?php if(isset($month_value)){if($month_value==7)echo 'selected';}  ?>>میزان</option>
                  <option value="8" <?php if(isset($month_value)){if($month_value==8)echo 'selected';}  ?>>عقرب</option>
                  <option value="9" <?php if(isset($month_value)){if($month_value==9)echo 'selected';}  ?>>قوس</option>
                  <option value="10" <?php if(isset($month_value)){if($month_value==10)echo 'selected';}  ?>>جدی</option>
                  <option value="11" <?php if(isset($month_value)){if($month_value==11)echo 'selected';}  ?>>دلو</option>
                  <option value="12" <?php if(isset($month_value)){if($month_value==12)echo 'selected';}  ?>>حوت</option>
                </select>
                <input type="submit" class="btn btn-primary" name="take_report" value="گرفتن گزارش">
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div id="collapse3" class="panel-collapse collapse <?=$c3?>">
            <div class="panel-body">
              <div class="yearly_report">
              <form action="<?php echo base_url();?>report/yearly_report" method="post">
                  <input type="text" name="year" value="<?php  if(isset($year_value))echo $year_value;?>"  placeholder="سال را وارد کنید">
                  <input type="submit" class="btn btn-primary" name="take_report" value="گرفتن گزارش">
                </form>
              </div>
          </div>
        </div>
      </div>
    </div>
    <!-- list of all mojres  -->
  </div>
  <!-- /.content-wrapper -->
  <div class="mojre_list table-responsive">
      <table class="table  table-bordered" style="background-color:#fff">
        <thead class="thead-light">
          <tr>
            <th>شماره</th>
            <th>نام</th>
            <th>مودل</th>
            <th>پلت </th>
            <th>نوعیت </th>
            <th>عکس</th>
          </tr>
        </thead>
        <tbody>
          <?php if(isset($persons)):$counter=1;foreach($persons as $row): ?>
            <tr>
              <td><?=$counter++;?></td>
              <td><?=$row['ssn']?></td>
              <td><?=$row['first_name']?></td>
              <td><?=$row['father_name']?></td>
              <td><?=$row['father_name']?></td>
              <td class="m_photo" >
                <a href="<?php echo base_url();?>assets/img/person_photos/<?=$row['person_image_name']?>.jpg" target="_blank">
                  <img src="<?php echo base_url();?>assets/img/person_photos/<?=$row['person_image_name']?>.jpg" alt="" height="50">
                </a>
              </td>
            </tr>
          <?php endforeach; else:?>
          
          <?php endif;?>
          </tbody>
          
      </table>
</div>
