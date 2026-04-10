$('#okBtn').click(function(){
    const url=$('#longUrl').val();
    $.post('/site/create',{url:url},function(data){
        if(data.error){
            $('#result').html('<div class="alert alert-danger">'+data.error+'</div>');
            return;
        }
        $('#result').html(
            '<p><img src="'+data.qr+'"></p>'+
            '<p><a href="'+data.hash+'" target="_blank">'+data.hash+'</a></p>'
        );
    },'json');
});
alert(124);
console.log(123);