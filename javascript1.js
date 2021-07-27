$('#formEscola').on('submit',function(event){
    event.preventDefault();
    var dados=$(this).serialize();

    $.ajax({
        url: 'controller/controlleremail.php',
        type: 'post',
        dataType: 'json',
        data: dados,
        success: function(response){
            $('.resultadoForm table tbody').empty();
            $.each(response,function(key,value){
                if(value.nota > 6){
                    $('.resultadoForm table tbody').append("<tr> <td>" + value.id + "</td> <td>" + value.nome + "</td> <td>" + value.nota + "</td> </tr> ");
                }
            });
        }
    });
});