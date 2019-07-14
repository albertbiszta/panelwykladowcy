$(document).ready(function(){

	deleteSyllabus();
});


var deleteSyllabus = () => 
{

	$('#delete-syllabus').click(function(event){
		let id = $(this).data('id');

		let deleteData = {
			"_token": $('#token').val(),
			"_method:": 'delete'
		};


		$.ajax({
			type: "DELETE",
			url: `/syllabuses/${id}/delete`,
			data: deleteData,
			success: function()
			{
				location.reload(); 



			}

		});




	});

	



}

