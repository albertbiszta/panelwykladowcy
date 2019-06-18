$(document).ready(function(){

	addGradeValidation();


});





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
		/*if((isInt(grade) && !isFloat(grade) || !isInt(grade) && isFloat(grade))){*/
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
