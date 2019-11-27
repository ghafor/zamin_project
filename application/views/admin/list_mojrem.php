<?php if(isset($_SESSION['lang']) && $_SESSION['lang'] != '') {
  $this->lang->load('main',$_SESSION['lang']);
}else {
  $this->lang->load('main','persian');
}?>
  <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        لیست مجرمین
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url();?>admin/"><i class="fa fa-dashboard"></i> خانه</a></li>
        <li class="active">لیست مجرمین</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
    <div class="container table-responsive">
    <h1></h1>
        <div class="serch_mojrem">
            <form action="<?=base_url();?>admin/list_mojrem" method="get">
                <div class="form-group">
                <select name="type" id="" class="form-control col-lg-2">
                   
                    <option value="ssn" <?php if(isset($type_back)) {if($type_back == 'ssn') echo 'selected';}?>>نمبر تذکره</option>
                    <option value="first_name" <?php if(isset($type_back)) {if($type_back == 'first_name') echo 'selected';}?>>نام</option>
                    <option value="father_name" <?php if(isset($type_back)) {if($type_back == 'father_name') echo 'selected';}?>>نام پدر</option>
                    <option value="place" <?php if(isset($type_back)) {if($type_back == 'place') echo 'selected';}?>>مکان جرم</option>
                </select>
                   <input type="text" class="form-control col-lg-2" name="keyword" placeholder="ورودی" value="<?php echo (isset($keyword)) ? $keyword : ''; ?>">
                   <input type="submit" class="btn btn-primary" name="search" value="جستجو" class="list_mojrem_btn_serach">
                    <span><?php if(isset($total_rows)) echo '<span>'.' مجموعه '.$total_rows.' نفر'.'</span>'; ?></span>
                </div>
                <div class="form-group"></div>
            </form>
        </div>
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <!-- <th>شماره</th> -->
                    <th>نمبر تذکره</th>
                    <th>نام</th>
                    <th>نام پدر</th>
                    <th>نام پدر کلان</th>
                    <th>ویرایش</th>
                </tr>
            </thead>
            <tbody>
                
                <?php if(isset($mojrems)):$counter=1;foreach($mojrems as $row):?>
                    <tr>
                        <!-- <td><?=$counter++;?></td> -->
                        <td><?=$row['ssn']?></td>
                        <td><?=$row['first_name']?></td>
                        <td><?=$row['father_name']?></td>
                        <td><?=$row['grand_father_name']?></td>
                        <td class="">
                        <?php if($_SESSION['write_person'] == '1'):?>
                            <a href="<?=base_url();?>admin/view_mojrem/<?=$row['id']?>" class="btn btn-primary">نمایش</a>
<?php else:echo '<p>غیر مجاز برای ادیت</p>'; endif;if($_SESSION['delete_person'] == '1'):?>
                            <a href="<?=base_url();?>admin/delete_mojrem_confirm/<?=$row['id']?>" class="btn btn-danger">حذف</a>
<?php else:echo '<p>غیر مجاز برای حذف!</p>'; endif;?>
                        </td>
                    </tr>
                <?php endforeach;else:?>
                    <tr>
                        <td colspan="6"><h3 align="center" class="alert alert-warning">اطلاعاتی برای نمایش وجود ندارد!</h3></td>
                    </tr>
                   
                <?php endif;?>
              
                </tbody>
        </table>
        <div class="pagination_section">
            <!-- <ul class="pagination">
                <li class="disabled"><a href="#">قبلی</a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">بعدی</a></li>
            </ul> -->
            <?=$pagination?>
        </div>
    </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 