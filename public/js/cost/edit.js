$('#btnSubmit').click(function(e){
    e.preventDefault();
    $('#btnSubmit').attr('disabled',true);
    $.ajax({
        type: 'PUT',
        url: $('#form').attr('action'),
        data: $('#form').serialize(),
        success: function(data){
            $('#btnSubmit').attr('disabled',false);
            if(!data.success){

            }else{
                swal({
                    title: 'Berhasil!',
                    text: data.message,
                    icon: 'success',
                    button: false
                })

                setInterval(() => {
                    window.location.href = url + data.redirect
                }, 2000);
            }
        },
        error: function(data){
            $('#btnSubmit').attr('disabled',false);
        }
    })
})