$(document).ready(function(){

	addGroup();

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

var addGroup = () => 
{
	$('#submitGroup').click(function(event){

		

		var name = $('#name').val();
		var year = $('#year').val();
		var contact = $('#contact').val();

		

		var postData = {
			"name": name,
			"year": year,
			"contact": contact,
			"_token": $('#token').val()
		};

		$.ajax({
			type: "POST",
			url: "/groups/new",
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


