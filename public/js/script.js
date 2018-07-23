(function($, undefined){
    $(function(){
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
        $('#phone').intlTelInput();

        $( ".delete" ).click(function() {
           if(!confirm('Are you sure you want to delete the company?')){
               event.preventDefault();
           }
        });

        $('body').on('click', '#create', function(e){
            e.preventDefault();
            let formData = new FormData($('#createForm')[0]);
            console.log(formData);
            axios.post('/company',formData)
                .then(function (response) {
                    //$('#myModalCreate').hide();
                    $('#myModalCreate').modal('hide');
                    $('#create').attr('data-dismiss', 'modal');

                    let str = "<tr>" +
                        "<td class='align-middle company-logo'>" +
                        "<img class='company-logo-img'  width='100px' " +
                        "src="+'images/logo/'+response.data['logo']+" " +
                        "alt="+response.data['name']+"></td>" +
                        "<td class='align-middle'>"+response.data['name']+"</td>" +
                        "<td class='align-middle' >"+response.data['country']+"</td>" +
                        "<td class='align-middle'>"+response.data['city']+"</td>" +
                        "<td class=\"align-middle\"><a class=\"btn btn-primary\"   href="+'company/'+response.data['id']+'/edit'+">Edit</a></td>"+

                        "<td class=\"align-middle\"><form method='POST' action="+'/company/'+response.data['id']+">" +
                        "<input type=\"hidden\" name=\"_method\" value=\"DELETE\" />" +
                        "<button type=\"submit\" class=\"btn btn-danger delete\">Delete</button>" +
                        "</form>" +
                        "</td>"+

                        "</tr>";
                   $('tbody').prepend(str);
                    console.log(response);

                })
                .catch(function (error) {
                    let errors = error.response.data.errors;
                    for (var key in errors) {
                        let strError = "<ul><li>"+errors[key]+"</li></ul>";
                        $('.error').addClass('alert alert-danger');
                        $('.error').append(strError);
                    }
                    console.log(error.response.data.errors);

                });




        })


    })
})(jQuery)