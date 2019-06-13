$(document).ready(function(){

	/*  /groups.show */
	addStudent();
	editStudent();
	deleteStudent();

});

/**/
var addStudent = () => 
{
	$('#submitStudent').click(function(event){

		let groupId = $('#groupId').val();
		let firstname = $('#firstname').val();
		let lastname = $('#lastname').val();
		let indexNumber = $('#indexNumber').val();
		let contact = $('#contact').val();

		let postData = {
			"group_id": groupId,
			"firstname": firstname,
			"lastname": lastname,
			"indexNumber": indexNumber,
			"contact": contact,
			"_token": $('#token').val()
		};


		$.ajax({
			type: "POST",
			url: "/students/add",
			data: postData,
			success: function(data)
			{
				$('#success-info').show();
				$('#info').html(data.success);
				appendStudent(data);

			}

		});



	});
}


var editStudent = () => 
{
	$('body').on('click', '.edit-student', function(){
		let id = $(this).data('id');
		let el = this;
		let groupId = $('#groupId').val();

		$("#firstnameEdit").attr("value",  $(this).data('firstname'));
		$("#lastnameEdit").attr("value",  $(this).data('lastname'));
		$("#indexNumberEdit").attr("value",  $(this).data('indexNumber'));
		$("#contactEdit").attr("value",  $(this).data('contact'));


		$('#submitEditStudent').click(function(event){

			let groupId = $('#groupId').val();
			let firstname = $('#firstnameEdit').val();
			let lastname = $('#lastnameEdit').val();
			let indexNumber = $('#indexNumberEdit').val();
			let contact = $('#contactEdit').val();

			let postData = {
				"group_id": groupId,
				"firstname": firstname,
				"lastname": lastname,
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
					$(el).closest('tr').remove();
					appendStudent(data);
					$('#success-info').show();
					$('#info').html(data.success);

				}

			});
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



var appendStudent = (data) => 
{

	var newRecord = `
	<tr>
	<td> ${data.student.firstname} </td>
	<td> ${data.student.lastname} </td>
	<td> ${data.student.indexNumber} </td>
	<td> ${data.student.contact} </td>
	<td>
	<a href="" data-toggle="modal" data-target="#editStudent" data-id="${data.student.id}"  class="btn btn-light btn-sm edit-student"><i class="far fa-edit fa-lg"></i></a>

	<button type="submit" data-toggle="modal" data-target="#confirm-delete" data-id="${data.student.id}" id="delete-student" class="btn btn-light btn-sm">
	<i class="far fa-trash-alt fa-lg"></i>
	</button>

	</td>
	</tr>
	`;

	$('#students-tbody').append(newRecord);
}
