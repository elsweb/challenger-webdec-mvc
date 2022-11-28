$(document).ready(function () {
    $('#telefone').inputmask('(99) 99999-9999')
})
$(document).on('click', '.addphone', function () {
    $("#datatable tbody tr td a").addClass('disabled')
    var table = $('#datatable').DataTable();
    let id = table.row($(this).parents('tr')).data()[0]
    let row = table.row($(this).parents('tr'))
    createPhone(id, row)
})
$(document).on('click', '.removephone', function () {
    if (confirm('Deseja remover este registro?')) {
        $("#datatable tbody tr td a").addClass('disabled')
        var table = $('#datatable').DataTable();
        let id = $(this).attr('id').split('_')[1]
        let row = table.row($(this).parents('tr'))
        window.row = row
        removePhone(id, row)
    }
})
function createPhone(id, row) {
    window.row = row
    clearForm('phoneform')
    $('#pessoas_id').val(id)
    $('#phoneModal').modal('toggle')
    $("#datatable tbody tr td a").removeClass('disabled')
}
function savePhone() {
    let base = $('meta[name=base_url]').attr('content')
    let csrf = $('meta[name=csrf]').attr('content')
    $("#submit_phone").attr("disabled", true)
    if ($('#msgloadphone').is(":visible")) {
        $('#msgloadphone').fadeOut('slow').queue(function () {
            $('#loadpreloadphone').fadeIn('slow')
            $(this).dequeue()
        })
    } else {
        $('#loadpreloadphone').fadeIn('slow')
    }
    $.ajax({
        url: `${base}/telefones/create`,
        type: "POST",
        data: $('#phoneform').serialize(),
        headers: {
            'X-CSRF-TOKEN': csrf,
        },
        success: function (response) {
            /*reload token*/
            if (response.token !== undefined) {
                $('meta[name=csrf]').attr('content', response.token);
            }
            $('#msgloadphone .alert').html(response.msg)
            if (response.status) {
                updateRow(response.row)
                clearForm('phoneform')
                $('#phoneModal').modal('toggle')
                $('#loadpreloadphone').fadeOut('slow')
            } else {
                $('#loadpreloadphone').fadeOut('slow').queue(function () {
                    $('#msgloadphone').fadeIn('slow')
                    $(this).dequeue()
                })
            }
            $("#submit_phone").attr("disabled", false)
        },
        error: function (error) {
            console.log(error)
        }
    });
}
function removePhone(id){
    let base = $('meta[name=base_url]').attr('content')
    let csrf = $('meta[name=csrf]').attr('content')
    $('#loadpreloaddelete').fadeIn('slow')
    $.ajax({
        url: `${base}/telefones/delete/${id}`,
        type: "DELETE",
        data: {},
        headers: {
            'X-CSRF-TOKEN': csrf,
        },
        success: function (response) {
            /*reload token for user login*/
            if (response.token !== undefined) {
                $('meta[name=csrf]').attr('content', response.token);
            }
            if (response.status) {
                updateRow(response.row)
                $('#loadpreloaddelete').fadeOut('slow')
                $("#datatable tbody tr td a").removeClass('disabled')
            }
        },
        error: function (error) {
            console.log(error)
        }
    });
}