$('#form_data').bind('submit', function(e){
	e.preventDefault();

	var data = $(this).serialize();

	$.ajax({
		url: 'http://localhost/aula/validate.php',
		type: 'POST',
		data: data,
		success:function(response){
			$('#result').html(response);
		}		
	});
});