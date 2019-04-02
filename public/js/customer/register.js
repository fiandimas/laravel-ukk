$('#btnSubmit').click(function(e){
    e.preventDefault();
    $('#btnSubmit').attr('disabled',true);
    $.ajax({
        type: 'POST',
        url: $('#sign_up').attr('action'),
        data: $('#sign_up').serialize(),
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
                    text: 'Berhasil daftar, silahkan login!',
                    icon: 'success',
                    button: false
                })

                setInterval(() => {
                    window.location.href = url + '/login'
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