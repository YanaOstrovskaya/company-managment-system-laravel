(function($, undefined){
    $(function(){
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
        $('#phone').intlTelInput();


        $('body').on('click', '#create', function(e){
            e.preventDefault();
            let formData = new FormData($('#createForm')[0]);
            //console.log(formData);
            axios.post('/company',formData)
                .then(function (response) {
                    $('#myModalCreate').modal('hide');
                    $('#create').attr('data-dismiss', 'modal');
                    let str = "<tr>" +
                        "<td class='align-middle company-logo'>" +
                        "<img class='company-logo-img'  width='100px' " +
                        "src="+'images/logo/'+response.data[0]['logo']+" " +
                        "alt="+response.data[0]['name']+"></td>" +
                        "<td class='align-middle link'>"+response.data[0]['name']+"</td>" +
                        "<td class='align-middle' >"+response.data[0]['country']+"</td>" +
                        "<td class='align-middle'>"+response.data[0]['city']+"</td>" +
                        "<td class=\"align-middle\"><a class=\"btn btn-primary\"   href="+'company/'+response.data[0]['id']+'/edit'+">Edit</a></td>"+
                        (response.data[1]==='admin'?
                            "<td class=\"align-middle\">" +
                            "<form method=\"POST\" action="+'/company/'+response.data[0]['id']+">"+
                            "<input type=\"hidden\" name=\"_method\" value=\"DELETE\" />"+
                            '<input type=\"hidden\" name=\"_token\" value='+$('meta[name="csrf-token"]').attr('content')+'>'+
                            "<button type=\"submit\" class=\"btn btn-danger delete\">Delete</button>"+
                             "</form>" +
                             "</td>"
                       :'')+
                        "</tr>";
                   $('tbody').prepend(str);
                    console.log(response);

                })
                .catch(function (error) {
                    let errors = error.response.data.errors;
                    for (let key in errors) {
                        let strError = "<ul><li>"+errors[key]+"</li></ul>";
                        $('.error').addClass('alert alert-danger');
                        $('.error').append(strError);
                    }
                    console.log(error.response.data.errors);

                });

        });

        $('body').on('click', '.delete', function(e) {
            e.preventDefault();
            let form = $(this).parent('form');
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    form.submit();
                    //console.log(form);
                }
            }).catch((error)=>{
                console.log(error);
            })
        });
        $('.datepicker').datepicker();


    })
})(jQuery)