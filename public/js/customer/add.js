$('#btnSubmit').click(function(e){
    e.preventDefault();
    $('#btnSubmit').attr('disabled',true);
    $.ajax({
        type: 'POST',
        url: $('#form').attr('action'),
        data: $('#form').serialize(),
        success: function(data){
            $('#btnSubmit').attr('disabled',false);
            if(!data.success){
                swal({
                    title: 'Gagal!',
                    text: data.message,
                    icon: 'error',
                })
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
        error: function(error){
            $('#btnSubmit').attr('disabled',false);
            swal({
                title: 'Gagal!',
                text: 'Silahkan coba lagi',
                icon: 'error'
            })
        }
    })
})