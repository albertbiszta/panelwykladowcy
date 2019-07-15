$(document).ready(function(){
	$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });


	$('#query').keyup(debounce(function(){
	$('#results').empty();

	
		var query = $(this).val();

		var errorInfo = () => {
			$('.student-results-table').hide();
			$('#no-result').show();
			var noResult = `
			<b>Student nie istnieje. Spróbuj wyszukać ponownie lub dodaj studenta</b>
			`;

			$('#no-result').html(noResult);

		};


		var successInfo = (value, group) => {
			
			$('#no-result').hide();
			$('.student-results-table').show();

			var result = `
			<tr>
			<td> ${value.first_name}  </td>
			<td> ${value.last_name}  </td>
			<td> ${value.index_number}  </td>
			<td> ${group.group}  </td>
			<td>  <a href="/students/${value.id}"> 
			<i class="far fa-list-alt fa-lg" ></i>
			</a></td>
			</tr>
			`;

			$('#results').append(result);

		};



		$.ajax({
			url:"/search-students",
			method:'GET',
			data:{query:query},
			dataType:'json',
			success:function(students)
			{

				$.each(students.students, function( index, value ){

					$.ajax({
						url:`/user-group/${value.group_id}`,
						method:'GET',
						data:{id:value.group_id},
						dataType:'json',
						success:function(group)
						{
							if(group.success == 'true'){

								successInfo(value, group);
							}

						},
						error:errorInfo()
					});
				});
				
			},
			error:errorInfo()
			
		});
	}, 500));

		//http://davidwalsh.name/javascript-debounce-function
		function debounce(func, wait, immediate) {
			var timeout;
			return function() {
				var context = this, args = arguments;
				var later = function() {
					timeout = null;
					if (!immediate) func.apply(context, args);
				};
				var callNow = immediate && !timeout;
				clearTimeout(timeout);
				timeout = setTimeout(later, wait);
				if (callNow) func.apply(context, args);
			};
		};



	});