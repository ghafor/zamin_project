$(document).ready(function(){
    //load_data();
function load_data(query){
        $.ajax({
            url:"http://localhost/criminal/vehicle/fetch",
            method:"POST",
            data:{query:query},
            success:function(data){
                $('#result').html(data);
                $('.mydata_table').css('display','none');

            }
        })
}
    $('#search_text').keyup(function(){

        var search=$(this).val();
        if (search !=''){
            load_data(search); 
        }
        else{
            //$('.mydata_table').css('display','block');
            //load_data();

        }

    });

});


