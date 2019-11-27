<div class="row">
        <div class="col-xs-12">
             <div class="box">
                  <div class="box-header">
                        <h3 class="box-title">تنظیمات سیستم</h3>
                  </div>
                  <!-- /.box-header -->
              <div class="box-body text-center">
            
                <div class="row">
                    <div class="col-lg-12">

                    <div class="row">
                        <div class="col-lg-6">

                           <div class="form-group">
                           </div>
                           <form action="<?=base_url();?>setting/update_setting" method="post">
                           <table class="table table-bordered table-striped table-hover table-responsive">
                               <tr>
                                   <th>شماره</th>
                                   <th>اسم</th>
                                   <th>قیمت</th>
                               </tr>
                            <?php
                            $arr['car_tax'] = 'تکس موتر';
                            $arr['motor_tax'] = 'تکس موترسیکل';
                            $arr['bycicle_tax'] = 'تکس بایسکل';
                            $arr['truck_tax'] = 'تکس لاری';
                            if(isset($taxes)):foreach($taxes as $item):?>
                               <tr>
                                   <td><?=$item['id']?></td>
                                   <td><?=$arr[$item['_key']]?></td>
                                   <td><input type="text" name="<?=$item['id']?>" id="tax" class="" value="<?php echo (isset($item['value'])) ? $item['value'] : 0;?>"></td>
                               </tr>
                            <?php endforeach;endif;?>
                              
                           </table>
                           <input type="submit" value="بروزرسانی" class="btn btn-block btn-primary">
                           </form>
                        </div>
                        <div class="col-lg-6">
                        </div>         
                    </div>
</div>               
              </form>
            </div>
           </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          </div>
          </div>