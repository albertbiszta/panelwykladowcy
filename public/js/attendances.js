$(document).ready(function(){

	saveAttendance();

});

var saveAttendance = () =>
{

	$('#submit-attendance').click(function(){

		let lessonId = $('#lessonId').val();



		$('select').each(function(){

			let status = $(this).val();
			let studentId = $(this).data('id');

			let postData = {
				"lesson_id": lessonId,
				"student_id": studentId,
				"status": status,
				"_token": $('#token').val()
			};


			$.ajax({
				type: "POST",
				url: '/attendances/save',
				data: postData,
				success(data)
				{
					let studentAttendance = `
					<tr>


					<td> ${data.student.lastname} </td>
					<td> ${data.student.firstname} </td>
					<td> ${data.student.lastname} </td>



					<td> 


					<div > 
					<select class="form-control" name="status" id="status" data-id="{{$student->id}}">
					
						 ${editStatusOptions(data.attendance.status)}


					</select>
					</div>

					</td>




					</tr>

					`;

					$('#attendances-tbody').append()

				}
			});


		});

		$('#main').empty();

		let table = `
		<table class="table table-bordered table-sm">
		<thead>
		<tr>
		<th scope="col">Nazwisko</th>
		<th scope="col">Imię</th>
		<th scope="col">Numer indeksu</th>
		<th scope="col">Status obecności</th>





		</th>

		</tr>
		</thead>
		<tbody id="attendances-tbody">

		</tbody>
		</table>

		`;


		$('#main').append(table);
		


	});
}


var editStatusOptions = (status) => 
{
	if(status == 'Obecny') {

		let options = `
		<option value="Obecny" disable="true" selected="true"> Obecny </option>
		<option value="Nieobecny"> Nieobecny </option>
		<option value="Nieobecność usprawiedliwiona"> Nieobecność usprawiedliwiona </option>
		`;

		return options;

	}else if(status == 'Nieobecny') {

		let options = `
		<option value="Nieobecny" disable="true" selected="true"> Nieobecny </option>
		<option value="Obecny"> Obecny </option>
		<option value="Nieobecność usprawiedliwiona"> Nieobecność usprawiedliwiona </option>
		`;

		return options;

	}else{

		let options = `
		<option value="Nieobecność usprawiedliwiona" disable="true" selected="true"> Nieobecność usprawiedliwiona </option>
		<option value="Obecny"> Obecny </option>
		<option value="Nieobecny"> Nieobecny </option>
		`;

		return options;
	}

}