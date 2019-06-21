$(document).ready(function(){

	saveGrades();
	updateGrade();
	deleteGrade();

});



var saveGrades = () =>
{

	$('#save-grades').click(function(){


		let subjectId = $('#subjectId').val();


		$('input.add-grade-input').each(function(){

			let value = $(this).val();  
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
				console.log(message);
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



var updateGrade = () => 
{
	$('body').on('click', '#grade-square', function(){
		let id = $(this).data('id');


		$("#editGradeValue").attr("placeholder",  $(this).data('value'));



		$('#submitGradeUpdate').click(function(event){

			let value = $('#editGradeValue').val();


			let valid = true;
			let message = '';

			if(!isInt(value) && !isFloat(value)){
				if(Number.isNaN(value)){
					message += 'Ocena musi być liczbą całkowitą lub zmiennoprzecinkową';
					valid = false;
				}
			}
			if(Number.isNaN(value)){
				message += 'Ocena musi być liczbą całkowitą lub zmiennoprzecinkową';
				valid = false;
			}



			if(valid == false) {
				console.log(message);
	/*			e.preventDefault();
				$('#validation-info').show();
				$('#validation-info').html(message);*/

			}else{

				let patchData = {
					"value": value,
					"_method:": 'PATCH',
					"_token": $('#token').val()
				};



				$.ajax({
					type: "PATCH",
					url: `/grades/${id}/update`,
					data: patchData,
					success: function(data)
					{
						location.reload(); 

					}

				});

			}


		});


	});

}

var deleteGrade = () => 
{
	$('body').on('click', '#grade-square', function(){
		let id = $(this).data('id');



		$('#delete-grade').click(function(event){



			let deleteData = {
				"_token": $('#token').val(),
				"_method:": 'delete'
			};


			$.ajax({
				type: "DELETE",
				url: `/grades/${id}/delete`,
				data: deleteData,
				success: function()
				{
					location.reload(); 



				}

			});




		});

	})



}



/*
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
*/
function isInt(n){
	return Number(n) === n && n % 1 === 0;
}

function isFloat(n){
	return Number(n) === n && n % 1 !== 0;
}

