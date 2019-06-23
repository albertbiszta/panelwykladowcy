$(document).ready(function(){

	deleteMaterial();

});


var deleteMaterial = () =>
{
	$('body').on('click', '#delete-material', function(){
		let id = $(this).data('id');

			let deleteData = {
				"_token": $('#token').val(),
				"_method:": 'delete'
			};


			$.ajax({
				type: "DELETE",
				url: `/materials/${id}/delete`,
				data: deleteData,
				success: function()
				{
					location.reload(); 



				}

			});
	});
	
}




var materialValidation = () =>
{
	$('#form-addLesson').submit(function(e){


		let date = $('#lessonDate').val();
		let topic = $('#topic').val();

		let valid = true;
		let message = '';


		if(date == ''){
			message += '<p>Wybierz datę zajęć</p>';
			valid = false;
		}
		if(topic == ''){
			message += '<p>Podaj temat zajęć</p>';
			valid = false;
		}

		

		if(valid == false) {
			e.preventDefault();
			$('#validation-info').show();
			$('#validation-info').html(message);
			
		}



	});
}