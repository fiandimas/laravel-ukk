let year = $('#year').find(':selected').val()
let id_customer = $('#id_customer').find(':selected').val()
$.ajax({
    type: 'POST',
    url: url + '/admin/month/usage',
    data: {
        id_customer: id_customer,
        year: year
    },
    dataType: 'html',
    success: function(data){
        $('#month').html(data).show()
    }
})

$('#id_customer').on('change', function(){
    let year = $('#year').find(':selected').val()
    let id_customer = $('#id_customer').find(':selected').val()
    $.ajax({
        type: 'POST',
        url: url + '/admin/month/usage',
        data: {
            id_customer: id_customer,
            year: year
        },
        dataType: 'html',
        success: function(data){
            $('#month').html(data).show()
        }
    })
})

$('#year').on('change', function(){
    let year = $('#year').find(':selected').val()
    let id_customer = $('#id_customer').find(':selected').val()
    $.ajax({
        type: 'POST',
        url: url + '/admin/month/usage',
        data: {
            id_customer: id_customer,
            year: year
        },
        dataType: 'html',
        success: function(data){
            $('#month').html(data).show()
        }
    })
})

$('#btnSubmit').click(function(e){
    e.preventDefault();
    $('#btnSubmit').attr('disabled',true);
    $.ajax({
        type: 'POST',
        url: $('#form').attr('action'),
        data: $('#form').serialize(),
        dataType: 'json',
        success: function(data){
            $('#btnSubmit').attr('disabled',false);
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
                    window.location.href = url + data.redirect
                }, 2000);
            }
        },
        error: function(data){
            $('#btnSubmit').attr('disabled',false);
            swal({
                title: 'Gagal!',
                text: 'Silahkan coba lagi',
                icon: 'error'
            })
        }
    })
})