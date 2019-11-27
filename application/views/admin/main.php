<?php if(isset($_SESSION['lang']) && $_SESSION['lang'] != '') {
  $this->lang->load('main',$_SESSION['lang']);
}else {
  $this->lang->load('main','persian');
}?>
<!-- ********************************************************************************* -->
    <!-- Main content -->
    <section class="content container-fluid">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?=$bycicle?></h3>

              <p><?=$this->lang->line('تعداد بایسکل');?></p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?=base_url();?>admin/list_vehicle" class="small-box-footer"><?=$this->lang->line('اطلاعات بیشتر'); ?><i class="fa fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?=$motors?><sup style="font-size: 20px"></sup></h3>
              <p><?=$this->lang->line('تعداد موترسواری');?></p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?=base_url();?>admin/list_vehicle" class="small-box-footer"><?=$this->lang->line('اطلاعات بیشتر'); ?> <i class="fa fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?=$cars?></h3>

              <p><?=$this->lang->line('تعداد موتور');?></p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?=base_url();?>admin/list_vehicle" class="small-box-footer"><?=$this->lang->line('اطلاعات بیشتر'); ?>  <i class="fa fa-arrow-circle-left"></i></a>
          </div>
        </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?=$trucks?></h3>

              <p><?=$this->lang->line('تعداد موتر باری');?></p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?=base_url();?>admin/list_mojrem" class="small-box-footer"><?=$this->lang->line('اطلاعات بیشتر'); ?>  <i class="fa fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?=$admin?></h3>

              <p><?=$this->lang->line('تعداد مدیران');?></p>
          
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="<?=base_url();?>admin/admins" class="small-box-footer"><?=$this->lang->line('اطلاعات بیشتر'); ?>  <i class="fa fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

      <div class="row">
        <div class="col-lg-6">
        <div class="box box-success">
            <div class="box-header">
              <i class="fa fa-info-circle"></i>
              <h3 class="box-title">
              <?=$this->lang->line('  به دیتابیس ثبت پارکینگ  خوش آمدید!');?>
</h3>
              <!-- tools box -->
              <div class="pull-left box-tools">
                <button type="button" class="btn bg-info btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <h5><?=$this->lang->line(' با استفاده از این دیتابیس شما قادر به ثبت اطلاعات ماشین خواهید بود.');?></h5>
              
              <br>
              <h5><b><?=$this->lang->line(' ویژگی های دیتابیس:');?> </b></h5>
              <h5>
              <?=$this->lang->line('  ۱- تمامی اطلاعات پارکینک  قابل ثبت می باشد.');?> </h5>
           
              <h5><?=$this->lang->line('    ۵- برای اطلاعات بیشتر به ');?>
                <a href="<?=base_url();?>admin/about_us"> <?=$this->lang->line('این');?></a>
                <?=$this->lang->line('  صفحه سر بزنید');?></h5>
              <br>
               </div>
          </div>
        </div>
        <div class="col-lg-6">
        <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-info-circle"></i>
              <h3 class="box-title">
              <?=$this->lang->line(' پنل دسترسی سریع');?>  </h3>
              <!-- tools box -->
              <div class="pull-left box-tools">
                <button type="button" class="btn bg-info btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-lg-6 pull-right">
                <a href="<?=base_url();?>vehicle/add_vehicle" class="btn bg-aqua btn-lg"> <?=$this->lang->line(' اضافه کردن مشخصات دخول');?> </a>
                </div>
                <div class="col-lg-6 pull-left">
                <a href="<?=base_url();?>vehicle/list_vehicle" class="btn bg-aqua btn-lg">  <?=$this->lang->line('لیست وسایط ');?></a>
                </div>
                 

              </div>
              <div class="row">
              

              </div>
               </div>
          </div>
        </div>
      </div>

          