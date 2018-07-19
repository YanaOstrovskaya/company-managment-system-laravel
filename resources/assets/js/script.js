(function($, undefined){
    $(function(){
        $('#phone').intlTelInput();

        $( ".delete" ).click(function() {
           if(!confirm('Are you sure you want to delete the company?')){
               event.preventDefault();
           }
        });

        $('body').on('click', '#create', function(e){
            e.preventDefault();
            $.ajax({
                type:'POST',
                url: '/company',
                data: {
                    '_token' : $('input[name=token]').val(),
                    'logo' : $('input[name=logo]').val(),
                    'name' : $('input[name=name]').val(),
                    'adress_line1' : $('input[name=adress_line1]').val(),
                    'adress_line2' : $('input[name=adress_line2]').val(),
                    'zip' : $('input[name=zip]').val(),
                    'province' : $('input[name=province]').val(),
                    'city' : $('input[name=city]').val(),
                    'country' : $('input[name=country]').val(),
                    'owner_id' : $('input[name=owner_id]').val(),
                },
                success: function (result) {
                    console.log(result);
                }

            })
        })

    })
})(jQuery)