<section class="content-header">
      <h1>لیست مدیران دیتابیس</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>admin/">خانه</a></li>

        <li class="active">لیست مدیران</li>
      </ol>
    </section>

<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
            </div>
            <?php if(isset($_SESSION['status'])):?>
            <div class="box text-center">
            <p class="alert alert-<?=$_SESSION['type']?>"><?=$_SESSION['status']?></p>
            </div>
            <?php endif;?>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>نام</th>
                  <th>تخلص</th>
                  <th>کلمه کاربری مدیر</th>
                 
                  <?php if($_SESSION['level'] ) {
                      
                      echo '<th>اجازه دسترسی</th>';
                      echo '<th>حذف مدیر</th>';

                  }
                  ?>
                  <!-- <th>تصویر</th> -->
                  

                </tr>
                </thead>
                <tbody>
                    <?php if(isset($list_admin)):foreach($list_admin as $row): ?>
                <tr style="background-color:<?php if($_SESSION['id'] == $row['id']) echo '#00e6ac'; ?>;">
                  <td><?=$row['first_name']?></td>
                  <td><?=$row['last_name']?></td>
                  <td><?=$row['username']?></td>
                  
                  <?php if($_SESSION['level'] ):?>
                  <td align="center"><a href="<?php echo base_url();?>admin/previlage_admin/<?=$row['id']?>"><img src="<?php echo base_url();?>assets/icons/permission.png" width="25"></a></td>
                  <td align="center"><a href="<?php echo base_url();?>admin/remove_admin/<?=$row['id']?>"><img src="<?php echo base_url();?>assets/icons/trash.png" width="25"></a></td>

                  <?php endif; ?>

                  <!-- <td>
                  <div class="pull-right image">
                      <img src="<?php echo base_url();?>assets/img/admin_photos/<?php echo $row['image_name'];?>.jpg" height="100" class="" alt="User Image">
                  </div>
                   </td> -->
                </tr>
                    
                   <?php endforeach;endif; ?>
                   
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          </div>
          </div>