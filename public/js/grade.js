$(document).ready(function(){

	addGradeValidation();
	saveGrades();

});



var saveGrades = () =>
{

	$('#save-grades').click(function(){

		let subjectId = $('#subjectId').val();


		$('input.add-grade-input').each(function(){

			let value = parseFloat($(this).val());  
			let student = $(this).data('id');



			let valid = true;
			let message = '';


			if(student == ''){
				message += '<p>Wybierz studenta</p>';
				valid = false;

			}
			if(!isInt(value) && !isFloat(value)){
				if(Number.isNaN(value)){
					message += '<p>Ocena musi być liczbą całkowitą lub zmiennoprzecinkową</p>';
					valid = false;
				}
			}
			if(Number.isNaN(value)){
				message += '<p>Ocena musi być liczbą całkowitą lub zmiennoprzecinkową</p>';
				valid = false;
			}



			if(valid == false) {
				console.log('zle');
	/*			e.preventDefault();
				$('#validation-info').show();
				$('#validation-info').html(message);*/

			}else{
				let postData = {
					"value": value,
					"student": student,
					"_token": $('#token').val()
				};



				if(value){
					$.ajax({
						type: "POST",
						url: `/grades/add/subject/${subjectId}`,
						data: postData,
						success: function() {   
							location.reload();  
						}

					});


				}




			}



		});

		


	});
}




var addGradeValidation = () =>
{
	$('#form-addGrade').submit(function(e){

		let student = $('#student').val();
		let grade = parseFloat($('#gradeValue').val());	  

		let valid = true;
		let message = '';


		if(student == ''){
			message += '<p>Wybierz studenta</p>';
			valid = false;
			
		}
		if(!isInt(grade) && !isFloat(grade)){
			if(Number.isNaN(grade)){
				message += '<p>Ocena musi być liczbą całkowitą lub zmiennoprzecinkową</p>';
				valid = false;
			}
		}
		if(Number.isNaN(grade)){
			message += '<p>Ocena musi być liczbą całkowitą lub zmiennoprzecinkową</p>';
			valid = false;
		}



		if(valid == false) {
			e.preventDefault();
			$('#validation-info').show();
			$('#validation-info').html(message);

		}



	});
}

function isInt(n){
	return Number(n) === n && n % 1 === 0;
}

function isFloat(n){
	return Number(n) === n && n % 1 !== 0;
}

