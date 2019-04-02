function accept(id){
    swal({
        title: 'Perhatian!',
        text: 'Apa anda yakin terima pembayaran ini ?',
        icon: 'warning',
        buttons: true
    }).then((ok) => {
        if(ok){
            $.ajax({
                type: 'PUT',
                url: url + '/admin/payment/accept/' + id,
                dataType: 'json',
                success: function(data){
                    swal({
                        title: 'Berhasil!',
                        text: data.message,
                        icon: 'success',
                        button: false
                    })

                    setInterval(() => {
                        window.location.reload();
                    }, 2000);
                },
                error: function(data){
                    swal({
                        title: 'Gagal!',
                        text: 'Silahkan coba lagi',
                        icon: 'error'
                    })
                }
            })
        }
    })
}

function reject(id){
    swal({
        title: 'Perhatian!',
        text: 'Apa anda yakin tolak pembayaran ini ?',
        icon: 'warning',
        buttons: true
    }).then((ok) => {
        if(ok){
            $.ajax({
                type: 'PUT',
                url: url + '/admin/payment/reject/' + id,
                dataType: 'json',
                success: function(data){
                    swal({
                        title: 'Berhasil!',
                        text: data.message,
                        icon: 'success',
                        button: false
                    })

                    setInterval(() => {
                        window.location.reload();
                    }, 2000);
                },
                error: function(data){
                    swal({
                        title: 'Gagal!',
                        text: 'Silahkan coba lagi',
                        icon: 'error'
                    })
                }
            })
        }
    })
}