$(document).ready(function(){

	materialValidation();
	deleteMaterial();

	$(".modal").on("hidden.bs.modal", function(){
		$('#validation-info').hide();
		$('#name').val("");
		$('#description').val("");

	});

});


var deleteMaterial = () =>
{
	$('body').on('click', '#delete-material', function(){
		let id = $(this).data('id');

		let deleteData = {
			"_token": $('#token').val(),
			"_method:": 'delete'
		};


		$.ajax({
			type: "DELETE",
			url: `/materials/${id}/delete`,
			data: deleteData,
			success: function()
			{
				location.reload(); 



			}

		});
	});
	
}




var materialValidation = () =>
{
	$('#form-addMaterial').submit(function(e){

		let name = $('#name').val();
		let file = $('#file');

		let valid = true;
		let message = '';


		if(file.get(0).files.length === 0){
			message += '<p> Wybierz plik </p>';
			valid = false;
		}
		if ($("#subject")[0].selectedIndex <= 0) {
			message += '<p> Wybierz przedmiot </p>';
			valid = false;
		}
		

		if(name == ''){
			message += '<p>Podaj nazwę pliku</p>';
			valid = false;
		}

		

		if(valid == false) {
			e.preventDefault();
			$('#validation-info').show();
			$('#validation-info').html(message);
			
		}



	});
}