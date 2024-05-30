import jQuery from 'jquery';
import {all} from "axios";
window.$ = jQuery;

$(document).ready(function(){
    $('#save').click(function(){
        let name = $('#name').val();
        let description = $('#description').val();
        let price = $('#price').val();
        let csrfToken = $('meta[name="csrf-token"]').attr('content');
        var formData = new FormData();
        let photo = $('#photo')[0].files[0];

        // Проверка на формат JPG
        if(photo && photo.type === 'image/jpeg') {
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
                        location.reload();
                    }
                },
                error:function(response){
                    alert(response.message);
                }
            });
        } else {
            alert('Пожалуйста, загрузите фото в формате JPG.');
        }
    });
});



