import jQuery from 'jquery';
window.$ = jQuery;

$(document).ready(function(){
    $('#save').click(function(){
        let name = $('#name').val();
        let description = $('#description').val();
        let price = $('#price').val();
        let csrfToken = $('meta[name="csrf-token"]').attr('content');
        var formData = new FormData();
        let photo = $('#photo')[0].files[0];

        formData.append('photo', photo);
        formData.append('name', name);
        formData.append('description', description);
        formData.append('price', price);

        //токен для доступа в контроллер
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        $.ajax({
            url: "dashboard",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response){
                if (response.message) {
                    $('.btn-close').trigger('click');
                }
            },
            error:function(response){
                // Обработка ошибки
            }
        });
    });
});


