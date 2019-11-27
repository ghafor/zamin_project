<div class="container-fluid">
    <div class="content">
    <div class="col-lg-3 pull-left" style="border:1px solid lightgray;">
        <button class="btn btn-primary" id="btn_show">آپلود ضمیمه</button>
        <form id="myform" action="<?=base_url();?>admin/upload_docs/<?=$id?>" method="post" enctype="multipart/form-data" style="display:none;">
            <label for="img">انتخاب عکس <span class="fa fa-upload"></span> </label>
            <input type="file" name="img" id="img">
            <input type="submit" value="آپلود" class="btn btn-primary pull-left">
        </form>
    </div>
        <div class="row">
            <?php $counter=1; foreach($documents as $row):?>
                <div class="col-lg-8" class="t">
                    <div class="caption">
                        <span class="pull-right">ضمیمه شماره <?=$counter++;?></span>
                        <a style="<?=$row['document_name']?>" class="btn btn-danger pull-left del_doc" style="margin-bottom:5px;">حذف ضمیمه</a>
                    </div>
                    <img id="docs_img" class="img img-responsive img-thumbnail" src="<?=base_url();?>assets/img/document/<?=$row['document_name']?>.jpg">
                </div>
                <div class="col-lg-12"><br><br><br></div>
            <?php endforeach;?>
        </div>
    </div>
</div>
<script src="<?=base_url();?>assets/js/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('#btn_show').click(function(){
        $('#myform').css('display','block');
        $(this).css('display','none');
    });
    $('#myform').change(function(){
        $('label').html('انتخاب شد');
    });

    $('.del_doc').click(function(e){
      e.preventDefault();
      let href = $(this).attr('style');
      let r = confirm('آیا مطمین هستید؟');
      if(r) {
         // alert('hi');
          $.post('http://localhost/criminal/admin/delete_doc',{
              img:href
          },function(data,status){
              //alert(data);
              if(data == 'true') {
                  //delete image
                 //$('#docs_img').attr('src','');
                 //$('.t').css('display','none');
                 location.reload();
               // location.reload();

              }else {
                  alert('عملیه حذف نا مکمل!');
              }
          // alert(data);
          });
      }
      //  alert(1);
    });
       
        
    
});

</script>