$(document).ready(function(){

	addSubject();
	deleteSubject();





});


var addSubject = () =>
{
	/*Add new subject*/
	$('#submitSubject').click(function(event){


		var examCheck = (exam) => {
			if(exam == 1) {
				return 'Tak';
			}else {
				return 'Nie';
			}
		}

		var appendToTable = (data) => {

			let newRecord = `
			<tr>
			<td> ${data.subject.name} </td>
			<td> ${data.subject.ects} </td>
			<td> ${examCheck(data.subject.exam)} </td>
			<td>   <a href="/subjects/${data.subject.id}"> 
			<i class="far fa-list-alt fa-lg" style="color: black"></i>
			</a></td>
			<td>

			<a href="" data-toggle="modal" data-target="#editSubject" data-id="${data.subject.id}" data-name="${data.subject.name}" class="btn btn-light btn-sm edit-subject"><i class="far fa-edit fa-lg"></i></a>


			<input type="hidden" name="subjectId" id="subjectId" value="{{ $subject->id }}">
			<button type="submit" data-toggle="modal" data-target="#confirm-delete" data-id="${data.subject.id}" id="delete-subject" class="btn btn-light btn-sm">
			<i class="far fa-trash-alt fa-lg"></i>
			</button>




			</td>
			</tr>
			`;

			$('#subjects-tbody').append(newRecord);
		};


		let name = $('#name').val();
		let ects = $('#ects').val();
		let exam = $('#exam').val();

		let postData = {
			"name": name,
			"ects": ects,
			"exam": exam,
			"_token": $('#token').val()
		};

		$.ajax({
			type: "POST",
			url: "/subjects/add",
			data: postData,
			success: function(data){
				$('#success-info').show();
				$('#info').html(data.success);
				appendToTable(data);

			}

		});

	});

}


var deleteSubject = () =>
{
	/*delete*/
	$('body').on('click', '#delete-subject', function(){
		let id = $(this).data('id');
		let el = this;

		$('#confirm-delete-subject').click(function(event){


			let sendData = {
				"_token": $('#token').val()
			};

			$.ajax({
				type: "DELETE",
				url: `/subjects/${id}/delete`,
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



var editSubject = () =>
{
	/*edit*/

	$('body').on('click', '.edit subject', function(){

		let id = $(this).data('id');
		let el = this;

		$('#submitEditSubject').click(function(event){




			$.ajax({
				type: "DELETE",
				url: `/subjects/edit/${id}`,
				data: {"id": id, "_token": $('#token').val()},
				success: function(data)
				{
					$('#success-info').show();
					$('#info').html(data.success);
					$(el).closest('tr').remove();
					appendToTable(data);
				}
			});


		});


	});
}

