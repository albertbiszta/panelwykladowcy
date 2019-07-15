$(document).ready(function(){

	/*  /groups.show */
	addStudent();
	editStudent();
	deleteStudent();

	$(".modal").on("hidden.bs.modal", function(){
		$('#validation-info').hide();
		$('#validation-edit-student').hide();
		$('.modal-body-add-student').find("input").val("");

	});




});

/**/
var addStudent = () => 
{



	$('#submitStudent').click(function(event){

		let groupId = $('#groupId').val();
		let firstName = $('#firstName').val();
		let lastName = $('#lastName').val();
		let indexNumber = $('#indexNumber').val();
		let contact = $('#contact').val();


		let validation = true;
		let message = '';

		if((firstName == '') || (lastName == '')){
			message += '<p>Musisz podać imię i nazwisko</p>';
			validation = false;
		}
		else if((firstName.length < 2 || firstName.length > 50) || (lastName.length < 2 || lastName.length > 50) ) {
			message += '<p>Imię i nazwisko muszą zawierać od 2 do 50 znaków</p>';
			validation = false;
		}


		if(indexNumber == '' || indexNumber.length < 4){
			message += '<p>Podaj prawidłowy numer indeksu</p>';
			validation = false;
		}


		if(validation == true) {
			let postData = {
				"group_id": groupId,
				"first_name": firstName,
				"last_name": lastName,
				"index_number": indexNumber,
				"contact": contact,
				"_token": $('#token').val()
			};


			$.ajax({
				type: "POST",
				url: "/students/store",
				data: postData,
				success: function(data)
				{
					closeModal();
					$('#success-info').show();
					$('#info').html(data.success);
					appendStudent(data);
				}

			});


		} else {
			$('#validation-info').show();
			$('#validation-info').html(message);
		}





	});
}


var editStudent = () => 
{
	$('body').on('click', '.edit-student', function(){
		let id = $(this).data('id');
		let el = this;
		let groupId = $('#groupId').val();

		$("#firstNameEdit").attr("value",  $(this).data('firstname'));
		$("#lastNameEdit").attr("value",  $(this).data('lastname'));
		$("#indexNumberEdit").attr("value",  $(this).data('indexnumber'));
		$("#contactEdit").attr("value",  $(this).data('contact'));


		$('#submitEditStudent').click(function(event){

			let groupId = $('#groupId').val();
			let firstName = $('#firstNameEdit').val();
			let lastName = $('#lastNameEdit').val();
			let indexNumber = $('#indexNumberEdit').val();
			let contact = $('#contactEdit').val();


			let validation = true;
			let message = '';

			if((firstName == '') || (lastName == '')){
				message += '<p>Musisz podać imię i nazwisko</p>';
				validation = false;
			}
			else if((firstName.length < 2 || firstName.length > 50) || (lastName.length < 2 || lastName.length > 50) ) {
				message += '<p>Imię i nazwisko muszą zawierać od 2 do 50 znaków</p>';
				validation = false;
			}




			if(indexNumber == '' || indexNumber.length < 4){
				message += '<p>Podaj prawidłowy numer indeksu</p>';
				validation = false;
			}


			if(validation == true) {

				let postData = {
					"group_id": groupId,
					"firstName": firstName,
					"lastName": lastName,
					"indexNumber": indexNumber,
					"contact": contact,
					"_token": $('#token').val()
				};



				$.ajax({
					type: "PATCH",
					url: `/students/${id}/update`,
					data: postData,
					success: function(data)
					{
						closeModal();
						$(el).closest('tr').remove();
						appendStudent(data);
						$('#success-info').show();
						$('#info').html(data.success);

					}

				});

			} else {
				$('#validation-edit-student').show();
				$('#validation-edit-student').html(message);
			}
		});


	});

}




/**/
var deleteStudent = () => 
{
	$('body').on('click', '#delete-student', function(){
		let id = $(this).data('id');
		let el = this;

		$('#confirm-delete-student').click(function(event){
			let sendData = {
				"_token": $('#token').val()
			};

			$.ajax({
				type: "DELETE",
				url: `/students/${id}/delete`,
				data: sendData,
				success: function(data)
				{

					$('#success-info').show();
					$('#info').html(data.success);
					$(el).closest('tr').remove();
				}
			});

		});


	});

}

var appendContact = (contact) =>
{
	if(contact == null){
		return '';
	}else{
		return contact;
	}
} 



var appendStudent = (data) => 
{

	var newRecord = `
	<tr>
	<td> ${data.student.first_name} </td>
	<td> ${data.student.last_name} </td>
	<td> ${data.student.index_number} </td>
	<td> ${appendContact(data.student.contact)} </td>

	

	<td>
	<a href="" data-toggle="modal" data-target="#editStudent" data-id="${data.student.id}"   
	data-firstname="${data.student.first_name}"   data-lastname="${data.student.last_name}"  data-indexnumber="${data.student.index_number}"    data-contact="${data.student.contact}" 
	class="btn btn-light btn-sm edit-student"><i class="far fa-edit fa-lg"></i></a>

	<button type="submit" data-toggle="modal" data-target="#confirm-delete" data-id="${data.student.id}" id="delete-student" class="btn btn-light btn-sm">
	<i class="far fa-trash-alt fa-lg"></i>
	</button>

	</td>
	</tr>
	`;

	$('#students-tbody').append(newRecord);
}

var closeModal = () =>
{
	$(".modal").removeClass("in");
	$(".modal-backdrop").remove();
	$('body').removeClass('modal-open');
	$('body').css('padding-right', '');
	$(".modal").hide();
}
