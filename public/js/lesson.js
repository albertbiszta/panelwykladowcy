$(document).ready(function(){

	validation();


});
 





/*var editLessonStatus = () =>
{

	$('#edit-lesson-status').click(function(event){

		let lessonId = $(this).data('id');


		let postData = {
			"id": lessonId,
			"_token": $('#token').val()
		};


		$.ajax({
			type: "PUT",
			url: `/lessons/${lessonId}/edit-status`,
			data: postData,
			success: function(data)
			{
	

			}

		});



	});

}*/


var validation = () =>
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