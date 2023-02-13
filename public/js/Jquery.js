const length = []; for(i=0;i<data;i++){
    length[i]=i+1;
 }
 $(document).ready(function() {
    $.each(length, function(index, val) {
        console.log(val);
        $('#item-'+val).click(function(){
            $('#item-'+val+'-child').toggle();
        });});
});