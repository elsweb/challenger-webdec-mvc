$(document).ready(function () {
    $('#cpf').inputmask('999.999.999-99')
    $("#cep").inputmask("99999-999")
    $('#rg').inputmask('99.999.999-9')
    fechData()    
});
$(document).on('click', '.delete', function () {
    $("#datatable tbody tr td a").addClass('disabled');
    var table = $('#datatable').DataTable();
    let id = table.row($(this).parents('tr')).data()[0]
    let row = table.row($(this).parents('tr'))
    remove(id, row)
});
function clearForm(form){
    $(`#${form}`).trigger("reset");
}
function fechData() {
    $('#loadpreloadlist').fadeIn('slow')
    let base = $('meta[name=base_url]').attr('content')
    let csrf = $('meta[name=csrf]').attr('content')
    $.ajax({
        url: `${base}/pessoas`,
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': csrf,
        },
        success: function (response) {
            $('#loadpreloadlist').fadeOut('slow').queue(function () {
                setDataTable(response.columns, response.data)
                $(this).dequeue();
            })
        },
        error: function (error) {
            $('#loadpreloadlist').fadeOut('slow').queue(function () {
                setDataTable([
                    { title: "#" }
                ], [])
                $(this).dequeue();
            })

        }
    });
}
function create() {
    let base = $('meta[name=base_url]').attr('content')
    let csrf = $('meta[name=csrf]').attr('content')
    $("#submit_reg").attr("disabled", true)
    if ($('#msgloadreg').is(":visible")) {
        $('#msgloadreg').fadeOut('slow').queue(function () {
            $('#loadpreloadreg').fadeIn('slow')
            $(this).dequeue()
        })
    } else {
        $('#loadpreloadreg').fadeIn('slow')
    }
    $.ajax({
        url: `${base}/pessoas/save`,
        type: "POST",
        data: $('#peopleform').serialize(),
        headers: {
            'X-CSRF-TOKEN': csrf,
        },
        success: function (response) {
            console.log(response)
            $('#msgloadreg .alert').html(response.msg)
            /*reload token for user login*/
            if (response.token !== undefined) {
                $('meta[name=csrf]').attr('content', response.token);
            }
            if (response.status) {
                var table = $('#datatable').DataTable();
                table.row.add(response.row).draw();
                $('#peopleform').trigger("reset");
                $('#registerModal').modal('toggle');
                $('#loadpreloadreg').fadeOut('slow');
            } else {
                $('#loadpreloadreg').fadeOut('slow').queue(function () {
                    $('#msgloadreg').fadeIn('slow')
                    $(this).dequeue()
                })
            }
            $("#submit_reg").attr("disabled", false)
        },
        error: function (error) {
            console.log(error)
        }
    });
}
function remove(id, row) {
    let base = $('meta[name=base_url]').attr('content')
    let csrf = $('meta[name=csrf]').attr('content')
    $('#loadpreloaddelete').fadeIn('slow')
    $.ajax({
        url: `${base}/pessoas/delete/${id}`,
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
                row.remove().draw()
                $('#loadpreloaddelete').fadeOut('slow')
                $("#datatable tbody tr td a").removeClass('disabled');
            }
        },
        error: function (error) {
            console.log(error)
        }
    });

}
function edit($id) {
    alert($id)
}
function addphone($id) {
    alert($id)
}