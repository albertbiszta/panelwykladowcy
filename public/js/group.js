$(document).ready(function(){

	/* /groups */
	addGroup();
	deleteGroup();
	editGroup();

	/*  /groups.show */
	addStudent();
	deleteStudent();

});

var appendToTable = (data) => {

	var newRecord = `
	<tr>
	<td> ${data.group.name} </td>
	<td> ${data.group.year} </td>
	<td> ${data.group.contact} </td>
	<td>   <a href="/groups/${data.group.id}"> 
	<i class="far fa-list-alt fa-lg" style="color: black"></i>
	</a></td>
	<td>

	<a href="" data-toggle="modal" data-target="#editGroup" data-id="${data.group.id}" data-name="${data.group.name}" class="btn btn-light btn-sm edit-group"><i class="far fa-edit fa-lg"></i></a>

	<input type="hidden" name="groupId" id="groupId" value="{{ $group->id }}">
	<button type="submit" data-toggle="modal" data-target="#confirm-delete" data-id="${data.group.id}" id="delete-group" class="btn btn-light btn-sm">
	<i class="far fa-trash-alt fa-lg"></i>
	</button>

	</td>
	</tr>
	`;

	$('#groups-tbody').append(newRecord);
};

var appendStudent = (data) => {

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
};



/**/
var addGroup = () => 
{
	$('#submitGroup').click(function(event){

		let name = $('#name').val();
		let year = $('#year').val();
		let contact = $('#contact').val();
		
		let postData = {
			"name": name,
			"year": year,
			"contact": contact,
			"_token": $('#token').val()
		};


		$.ajax({
			type: "POST",
			url: "/groups/add",
			data: postData,
			success: function(data)
			{
				$('#success-info').show();
				$('#info').html(data.success);
				appendToTable(data);

			}

		});



	});
}


/**/
var deleteGroup = () => 
{
	$('body').on('click', '#delete-group', function(){
		let id = $(this).data('id');
		let el = this;

		$('#confirm-delete-group').click(function(event){


			let sendData = {
				"_token": $('#token').val()
			};

			$.ajax({
				type: "DELETE",
				url: `/groups/delete/${id}`,
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


var editGroup = () => 
{
	$('body').on('click', '.edit-group', function(){
		let id = $(this).data('id');
		let el = this;

		$("#nameEdit").attr("value",  $(this).data('name'));
		$("#yearEdit").attr("value",  $(this).data('year'));
		$("#contactEdit").attr("value",  $(this).data('contact'));

		$('#submitEditGroup').click(function(event){

			let name = $('#nameEdit').val();
			let year = $('#yearEdit').val();
			let contact = $('#contactEdit').val();

			let postData = {
				"name": name,
				"year": year,
				"contact": contact,
				"_token": $('#token').val()
			};


			

			$.ajax({
				type: "PATCH",
				url: `/groups/${id}/update`,
				data: postData,
				success: function(data)
				{
					$(el).closest('tr').remove();
					$('#success-info').show();
					$('#info').html(data.success);
					appendToTable(data);

					
				}
			});

		});


	});

}




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
			url: "/students/new",
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

