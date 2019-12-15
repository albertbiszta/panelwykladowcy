$(document).ready(function(){

    addSubject();
    deleteSubject();
    editSubject();


});



var addSubject = () =>
{
    /*Add new subject*/
    $('#submitSubject').click(function(event){



        let name = $('#name').val();
        let ects = parseInt($('#ects').val());
        let exam = $('#exam').val();

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
        if(Number.isNaN(ects)){
            message += '<p>Liczba punktów ECTS musi być liczbą całkowitą</p>';
            validation = false;
        }

        if(validation == true){

            let postData = {
                "name": name,
                "ects": ects,
                "exam": exam,
                "_token": $('#token').val()
            };



            $.ajax({
                type: "POST",
                url: "/subjects/store",
                data: postData,
                success: function(data){

                    closeModal();
                    $('#success-info').show();
                    $('#info').html(data.success);
                    appendToTable(data);
                    $('#validation-info').hide();



                    /*		$('.modal-backdrop').css('background-color', 'transparent');*/

                }

            });

        }else{
            $('#validation-info').show();
            $('#validation-info').html(message);
        }



    });

}

var editSubject = () =>
{
    $('body').on('click', '.edit-subject', function(){

        let el = this;
        $("#nameEdit").attr("value",  $(this).data('name'));
        $("#ectsEdit").attr("value",  $(this).data('ects'));

        $('#submitEditSubject').click(function(event){

            let id = $('#subjectId').val();
            let name = $('#nameEdit').val();
            let ects = parseInt($('#ectsEdit').val());
            let exam = $('#examEdit').val();

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
            if(Number.isNaN(ects)){
                message += '<p>Liczba punktów ECTS musi być liczbą całkowita</p>';
                validation = false;
            }


            if(validation == true){


                let postData = {
                    "name": name,
                    "ects": ects,
                    "exam": exam,
                    "_token": $('#token').val()
                };



                $.ajax({
                    type: "PATCH",
                    url: `/subjects/${id}/update`,
                    data: postData,
                    success: function(data)
                    {
                        let editedHeader = `
						<b> ${data.subject.name} </b>   
						<div class="float-right">
						<a href="" data-toggle="modal" data-target="#editSubject" data-id="${data.subject.id}" 
						data-name="${data.subject.name}" data-ects="${data.subject.ects}" 
						class="btn btn-light btn-sm edit-subject">
						<i class="far fa-edit fa-lg"></i> Edytuj przedmiot
						</a>
						
						</div>
						`;

                        $('#subject-header').html(editedHeader);
                        closeModal();


                        $('#validation-edit').hide();
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





/**//**/
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
	<button type="submit" data-toggle="modal" data-target="#confirm-delete" data-id="${data.subject.id}" id="delete-subject" class="btn btn-light btn-sm">
	<i class="far fa-trash-alt fa-lg"></i>
	</button>
	</td>
	</tr>
	`;

    $('#subjects-tbody').append(newRecord);
}




var closeModal = () =>
{
    $(".modal").removeClass("in");
    $(".modal-backdrop").remove();
    $('body').removeClass('modal-open');
    $('body').css('padding-right', '');
    $(".modal").hide();
}