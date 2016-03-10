$(function(){
	$(':submit').on('click',function(event){
		event.preventDefault();
		$.ajax({
			method:'POST',
			url : '/convs/'+$('input[name$="id_conv"]').val()+'/add',
			 success: function(data) {
			   	$('ul').append('<li>'+data+'</li>');
			 }
		});
	});
});