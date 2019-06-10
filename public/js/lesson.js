$(document).ready(function(){

	addLesson();

});



/**/
var addLesson = () => 
{
	$('#submitLesson').click(function(event){

		let date = $('#date').val();
		let topic = $('#topic').val();
		let performed = 0;

		$('#performed').is(':checked') ?  performed = 1 : performed = 0;

		let subjectId = $('#subjectId').val();
		let groupId = $('#groupId').val();

		
		let postData = {
			"subjectId": subjectId,
			"groupId": groupId,
			"date": date,
			"topic": topic,
			"performed": performed,
			"_token": $('#token').val()
		};


		$.ajax({
			type: "POST",
			url: "/lessons/add",
			data: postData,
			success: function(data)
			{
			/*	$('#success-info').show();
				$('#info').html(data.success);
				appendToTable(data);*/

			}

		});



	});
}



var appendToTable = (data) => 
{

	var performed = (status) => 
	{
		status == 1 ? return 'Odbyły się' : return 'Nie odbyły się';
		if(status == 1) {
			let add = `
			<td> Odbyły się </td>
			<td>   </td>

			`;
			return add;
		}
	}

	var newRecord = `
	<tr>

	<td> ${data.lesson.date->format('d-m-Y')} </td> 

	<td> ${data.lesson.topic} </td>

	
	<td> ${performed(data.lesson.performed)} </td>

	<td>

	</td>

	<td>
	@if ($groupLesson->performed == 1)

	<a href="{{ action('AttendanceController@lessonAttendance', $groupLesson->id) }}" style="color: black"> 
	<i class="fas fa-chalkboard" style="color: black"></i>

	</a>
	@endif	
	</td>









	</tr>
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

	$('#lessons-tbody').append(newRecord);
}



/*var editLessonStatus = ()
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