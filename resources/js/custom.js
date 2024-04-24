import jQuery from 'jquery';
window.$ = jQuery;

$(document).ready(function(){
    $('#save').click(function(){
        let name = $('#name').val();
        let description = $('#description').val();
        let price = $('#price').val();


        $.ajax({
            url: "{{ route('dashboard') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                // Добавьте другие данные, если необходимо
            },
            success:function(response){
                // Обработка успешного ответа
            },
            error:function(response){
                // Обработка ошибки
            }
        });


    });
});


