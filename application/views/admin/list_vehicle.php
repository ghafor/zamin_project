<?php if(isset($_SESSION['lang']) && $_SESSION['lang'] != '') {
  $this->lang->load('main',$_SESSION['lang']);
}else {
  $this->lang->load('main','persian');
}?>
<!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>لیست وسایط نقلیه</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>admin/">خانه</a></li>
        <li class="active">لیست وسایط نقلیه</li>
      </ol>
      <div class="form-group">
        <div class="input-group">
        <span class="input-group-addon">Search</span>
        <input type="text" name ="search_text" id="search_text" placeholder="search by car details" class="form-control">

        </div>
          </div> 
          <div id="result"></div>


<!-- 
      <div class="searching"> 
     <div class="topnav">
      
  <input class="search" type="text" placeholder="Search..">
  <button type="button"><i class="fa fa-search"></i></button>
<div>
</div> -->
 
    </section>

    <!-- start the form the add the mojrem info-->

    <div class="container-fluid">
      <div class="row main-content">
            <?php if(isset($_SESSION['status'])):?>
                  <div class="box text-center">
                  <p class="alert alert-<?=$_SESSION['type']?>"><?=$_SESSION['status']?></p>
                  </div>
                  <?php endif;?>
                <table class="table table-reponsive table-bordered table-striped mydata_table">
              <tr>
                <th>شماره</th>
                <th>نام</th>
                <th>مودل</th>
                <th>پلت</th>
                <th>انواع</th>
                <th>ویرایش</th>
                <th>حذف</th>
                <th> خروجی</th>
                <th>عکس</th>
                
              </tr>
            <?php $counter=1; foreach($vehicle as $item){ ?>
             <tr>
                <td><?=$counter++; ?></td>
                <td><?=$item->name;?></td>
                <td><?=$item->model;?></td>
                <td><?=$item->plate;?></td>
                <td><?=$item->type;?></td>
               <!-- <td><?echo date($today);?></td>-->
                <td><a href="<?=base_url()?>vehicle/edit/<?=$item->id;?>" class="btn btn-success">ویرایش</a></td>
                <td><a href="<?=base_url()?>vehicle/delete/<?=$item->id;?>" class="btn btn-danger">حزف</a></td>
                <td><a href="<?=base_url()?>vehicle/out_go/<?=$item->id;?>" class="btn btn-danger"> خروج</a></td>
                    <?php 
                        //echo base_url().'/assets/uploads'.$item->img_url.'.jpg';
                    ?>
                <td>
                      <a href="<?php echo base_url().'assets/uploads/'.$item->img_url.'.jpg';?>" target="_blank"><img width="70px" id="<?=$item->id;?>" onmouseout="small(this.id)" onmouseover="big(this.id);" src="<?php echo base_url().'assets/uploads/'.$item->img_url.'.jpg';?>" class="img img-reponsive" alt="">
                </a>
                </td>
                <?php }?>

              
            </tr>
          </div>
          </div>

             <?php
              //echo "<tr><td>".$r['id']."</td><td><br>".$r['name']."</td><td><br>".$r['model']."</td><td>".$r['plate']."</td><td>".$r['img_url']."</td><td>".$r['type']."</td></tr>";  
              ?>


            </table>
              <?php echo"</br>".$this->pagination->create_links();?>
           <script>
            // function big(id) {
            //   $(document).ready(function(){
            //     $('#'+id).css('width','300px');
            //   });
            // }
            // function small(id) {
            //   $(document).ready(function(){
            //     $('#'+id).css('width','70px');
            //   });
            // }
           </script>