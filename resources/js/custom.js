import jQuery from 'jquery';
window.$ = jQuery;

$(document).ready(function(){
    $('#save').click(function(){

        let name = $('#name').val();
        let description = $('#description').val();
        let price = $('#price').val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        console.log(csrfToken);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        $.ajax({
            url: "dashboard",
            type: "POST",
            data: {
                //"_token": "{{ csrf_token() }}",
                name: name,
                description: description,
                price: price
            },
            success:function(response){
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


