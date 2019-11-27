<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">لیست مدیران سیستم</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body text-center">
            
            <div class="col-lg-12 text-center">
                
                  <label for="">آیا مطمین هستید مدیر را حذف کنید؟</label><br>
                  <a class="btn btn-primary" href="<?php echo base_url(); ?>admin/remove_admin/<?=$admin[0]['id']?>/false">خیر، مطمئن نیستم</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <a class="btn btn-primary" href="<?php echo base_url(); ?>admin/remove_admin/<?=$admin[0]['id']?>/true">بله، مطئنم</a>
               
              </div>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          </div>
          </div>