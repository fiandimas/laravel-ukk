$('#form').submit(function(e){
    e.preventDefault();
    $('#btnSubmit').attr('disabled',true);
    var a = this;
    $.ajax({
        type: 'POST',
        url: $('#form').attr('action'),
        data: new FormData(a),
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(data){
            $('#btnSubmit').attr('disabled',false);
            if(data.success){
                swal({
                    title: 'Berhasil!',
                    text: data.message,
                    icon: 'success',
                    button: false
                })

                setInterval(() => {
                    window.location.reload()
                }, 2000);
            }
        },
        error: function(data){
            $('#btnSubmit').attr('disabled',false);
            swal({
                title: 'Gagal!',
                text: 'Silahkan coba lagi!',
                icon: 'error'
            })
        }
    })
})