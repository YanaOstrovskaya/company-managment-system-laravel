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
                        "<td class='align-middle'>"+response.data[0]['name']+"</td>" +
                        "<td class='align-middle' >"+response.data[0]['country']+"</td>" +
                        "<td class='align-middle'>"+response.data[0]['city']+"</td>" +
                        "<td class=\"align-middle\"><a class=\"btn btn-primary\"   href="+'company/'+response.data[0]['id']+'/edit'+">Edit</a></td>"+
                        (response.data[1]==='admin'?
                        "<td class=\"align-middle\">" +
                            "<button type=\"button\" class=\"btn btn-danger delete\" data-toggle=\"modal\" data-target=\"#myModalDelete\">Delete</button>"+
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




        })

        $('body').on('click', '.delete', function(e) {
            if(!confirm('Are you sure you want to delete the company?')){
                e.preventDefault();
            }
        });


    })
})(jQuery)