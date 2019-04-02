function deleteCustomer(id){
    swal({
        title: 'Perhatian!',
        text: 'Apa anda yakin hapus data ini ?',
        icon: 'warning',
        buttons: true
    }).then((ok) => {
        if(ok){
            $.ajax({
                type: 'DELETE',
                url: url + '/admin/customer/' + id,
                success: function(data){
                    if(!data.success){
                        swal({
                            title: 'Gagal!',
                            text: data.message,
                            icon: 'error'
                        })
                    }else{
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
                }
            })
        }
    })
}