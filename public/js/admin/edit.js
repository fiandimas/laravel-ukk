$('#btnSubmit').click(function(e){
    e.preventDefault();
    $('#btnSubmit').attr('disabled',true);
    $.ajax({
        type: 'PUT',
        url: $('#form').attr('action'),
        data: $('#form').serialize(),
        success: function(data){
            $('#btnSubmit').attr('disabled',false);
            swal({
                title: 'Berhasil!',
                text: 'Sukses edit admin',
                icon: 'success',
                button: false
            })

            setInterval(() => {
                window.location.href = url + data.redirect
            }, 2000);
        },
        error: function(){
            $('#btnSubmit').attr('disabled',false);
            swal({
                title: 'Gagal!',
                text: 'Silahkan coba lagi',
                icon: 'error'
            })
        }
    })
})