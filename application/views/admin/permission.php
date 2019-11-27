<section class="content-header">
      <h1>تغییر دسترسی مدیر</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>admin/">خانه</a></li>
        <li><a href="<?php echo base_url();?>admin/admins">لیست مدیران</a></li>
        <li class="active">تغییر دسترسی</li>
      </ol>
    </section>

<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
            </div>
            <?php if(isset($_SESSION['status'])):?>
            <div class="box text-center">
                <p class="alert alert-<?=$_SESSION['type']?>"><?=$_SESSION['status']?></p>
            </div>
            <?php endif;?>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <?php  if(isset($admin)):?>
                <form action="<?php echo base_url();?>admin/previlage_admin/<?=$admin[0]['id']?>" method="post">

                
                <thead>
                <tr>
                    <th>نام</th>
                    <th>تخلص</th>
                    <th>ارتقا درجه</th>
                    <th>اجازه حذف مجرم</th>
                    <th>اجازه ویرایش اطلاعات مجرم</th>
                    <th>اجازه اضافه کردن مدیر جدید</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($admin as $row): ?>
                <tr>
                  <td><?=$row['first_name']?></td>
                  <td><?=$row['last_name']?></td>
                  
                  <td>
                      <?php $level1 = $level2 = '';?>
                      <?php ($row['level'] == 1) ?$level1='checked' : $level2 = 'checked'; ?>
                      
                      <div class="radio">
                    <label>
                      <input type="radio" name="level" id="level" value="1" <?=$level1;?>>
                      درجه اول
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="level" id="level2" value="2" <?=$level2;?>>
                      درجه دوم
                    </label>
                  </div>

                    </td>
                   

                    
                  
                    


                    <td align="center">
                    <?php $delete_p_y = $delete_p_n = '';?>
                      <?php ($row['delete_person'] == 1) ?$delete_p_y='checked' : $delete_p_n = 'checked'; ?>

                      <div class="radio">
                    <label>
                      <input type="radio" name="delete_p" id="level" value="1" <?=$delete_p_y;?>>
                      دارد
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="delete_p" id="level2" value="0" <?=$delete_p_n;?>>
                      ندارد
                    </label>
                    </td>


                    <td align="center">
                    <?php $write_p_y = $write_p_n = '';?>
                      <?php ($row['write_person'] == 1) ?$write_p_y='checked' : $write_p_n = 'checked'; ?>

                      <div class="radio">
                    <label>
                      <input type="radio" name="write_p" id="level" value="1" <?=$write_p_y;?>>
                      دارد
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="write_p" id="level2" value="0" <?=$write_p_n;?>>
                      ندارد
                    </label>

                    </td>
                   
                    <td>
                    <?php $add_p_y = $add_p_n = '';?>
                      <?php ($row['add_admin'] == 1) ?$add_p_y='checked' : $add_p_n = 'checked'; ?>

                      <div class="radio">
                    <label>
                      <input type="radio" name="add_p" id="level" value="1" <?=$add_p_y;?>>
                      دارد
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="add_p" id="level2" value="0" <?=$add_p_n;?>>
                      ندارد
                    </label>
                    </td>
                    
                  
                </tr>
                   <?php endforeach;endif; ?>
                </tbody>
                
              </table>
              
              <div class="row container-fluid pull-left" style="margin-top:5px;">
                <input type="submit" name="submit" class="btn btn-primary" value="ذخیره تنظیمات">
              </div>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          </div>
          </div>