$(document).ready(function(){

	/* /groups */
	addGroup();
	deleteGroup();
	editGroup();


});

var appendGroupToTable = (data) => {

	var newRecord = `
	<tr>
	<td> ${data.group.name} </td>
	<td> ${data.group.contact} </td>
	<td>   <a href="/groups/${data.group.id}"> 
	<i class="far fa-address-card fa-lg" style="color: black"></i>
	</a></td>
	<td>
	

	<button type="submit" data-toggle="modal" data-target="#confirm-delete" data-id="${data.group.id}"  id="delete-group" class="btn btn-light btn-sm">
	<i class="far fa-trash-alt fa-lg"></i>
	</button>

	

	</td>
	</tr>
	`;

	$('#groups-tbody').append(newRecord);
};





/**/
var addGroup = () => 
{
	$('#submitGroup').click(function(event){

		let name = $('#name').val();
		let contact = $('#contact').val();


		let validation = true;
		let message = '';

		if(name == ''){
			message += '<p>Nazwa nie może być pusta</p>';
			validation = false;
		}
		if(name.length < 2 || name.length > 50){
			message += '<p>Nazwa musi zawierać od 2 do 50 znaków</p>';
			validation = false;
		}
	

		if(validation == true){ 
			let postData = {
				"name": name,
				"contact": contact,
				"_token": $('#token').val()
			};


			$.ajax({
				type: "POST",
				url: "/groups/add",
				data: postData,
				success: function(data)
				{
					closeModal();
					$('#success-info').show();
					$('#info').html(data.success);
					appendGroupToTable(data);
					$('#validation-info').hide();

				}

			});
		}else{
			$('#validation-info').show();
			$('#validation-info').html(message);
		}



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
				url: `/groups/${id}/delete`,
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
		
		$("#contactEdit").attr("value",  $(this).data('contact'));

		$('#submitEditGroup').click(function(event){

			let name = $('#nameEdit').val();
			
			let contact = $('#contactEdit').val();


			let validation = true;
			let message = '';

			if(name == ''){
				message += '<p>Nazwa nie może być pusta</p>';
				validation = false;
			}
			if(name.length < 2 || name.length > 50){
				message += '<p>Nazwa musi zawierać od 2 do 50 znaków</p>';
				validation = false;
			}
			

			if(validation == true){ 

				let postData = {
					"name": name,
					"contact": contact,
					"_token": $('#token').val()
				};


				

				$.ajax({
					type: "PATCH",
					url: `/groups/${id}/update`,
					data: postData,
					success: function(data)
					{
						let editedHeader = `
						<b> ${data.group.name} </b>   
						<div class="float-right">

						<a href="" data-toggle="modal" data-target="#editGroup" data-id="{{$group->id}}" 
						data-name="${data.group.name}" data-contact=" ${data.group.contact}" 
						class="btn btn-light btn-sm edit-group"><i class="far fa-edit fa-lg"></i>
						Edytuj grupę
						</a>

						</div>
						`;

						$('#group-header').html(editedHeader);
						closeModal();
						$('#success-info').show();
						$('#info').html(data.success);
					}
				});

			}else{
				$('#validation-edit').show();
				$('#validation-edit').html(message);

			}

		});


	});

}

var closeModal = () =>
{
	$(".modal").removeClass("in");
	$(".modal-backdrop").remove();
	$('body').removeClass('modal-open');
	$('body').css('padding-right', '');
	$(".modal").hide();
}




