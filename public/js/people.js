$(document).ready(function () {
    /*clear forms and set mask*/
    clearForm('peopleform')
    $('#cpf').inputmask('999.999.999-99')
    $("#cep").inputmask("99999-999")
    $('#rg').inputmask('99.999.999-9')
    /*get data to datatable*/
    fechData()
});
$(document).on('click', '.update', function () {
    if (confirm('Deseja atualziar este registro?')) {
        $("#datatable tbody tr td a").addClass('disabled')
        var table = $('#datatable').DataTable();
        let id = table.row($(this).parents('tr')).data()[0]
        let row = table.row($(this).parents('tr'))
        edit(id, row)
    }
});
$(document).on('click', '.delete', function () {
    if (confirm('Deseja remover este registro?')) {
        $("#datatable tbody tr td a").addClass('disabled')
        var table = $('#datatable').DataTable();
        let id = table.row($(this).parents('tr')).data()[0]
        let row = table.row($(this).parents('tr'))
        remove(id, row)
    }
});
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
function save() {
    /*change methods*/
    let id = $('#peopleform #id').val()
    if (id !== '') {
        update()
    } else {
        create()
    }
    return false
}
function add() {
    clearForm('peopleform')
    $('#msgloadreg').css('display', 'none')
    $('#btnclear').css('display', 'inline-block')
    $('#registerModal').modal('toggle')
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
        url: `${base}/pessoas/create`,
        type: "POST",
        data: $('#peopleform').serialize(),
        headers: {
            'X-CSRF-TOKEN': csrf,
        },
        success: function (response) {
            /*reload token*/
            if (response.token !== undefined) {
                $('meta[name=csrf]').attr('content', response.token);
            }
            $('#msgloadreg .alert').html(response.msg)
            if (response.status) {
                var table = $('#datatable').DataTable()
                table.row.add(response.row).draw()
                clearForm('peopleform')
                $('#registerModal').modal('toggle')
                $('#loadpreloadreg').fadeOut('slow')
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
                $("#datatable tbody tr td a").removeClass('disabled')
            }
        },
        error: function (error) {
            console.log(error)
        }
    });
}
function update() {
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
        url: `${base}/pessoas/update`,
        type: "POST",
        data: $('#peopleform').serialize(),
        headers: {
            'X-CSRF-TOKEN': csrf,
        },
        success: function (response) {
            /*reload token*/
            if (response.token !== undefined) {
                $('meta[name=csrf]').attr('content', response.token);
            }
            $("#submit_reg").attr("disabled", false)
            $('#msgloadreg .alert').html(response.msg)
            if (response.status) {
                clearForm('peopleform')
                updateRow(response.data)
                $('#registerModal').modal('toggle')
                $('#loadpreloadreg').fadeOut('slow')
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
function edit(id, row) {
    window.row = row
    let base = $('meta[name=base_url]').attr('content')
    let csrf = $('meta[name=csrf]').attr('content')
    $("#datatable tbody tr td a").addClass('disabled')
    $('#loadpreloaddelete').fadeIn('slow')
    $('#btnclear').css('display', 'none')
    $('#msgloadreg').css('display', 'none')
    $.ajax({
        url: `${base}/pessoas/view/${id}`,
        type: "GET",
        data: {},
        headers: {
            'X-CSRF-TOKEN': csrf,
        },
        success: function (response) {
            /*reload token for user login*/
            if (response.token !== undefined) {
                $('meta[name=csrf]').attr('content', response.token);
            }
            if (response.data.pessoas !== undefined) {
                let pessoas = response.data.pessoas
                $('#peopleform #id').val(pessoas.id)
                $('#peopleform #nome').val(pessoas.nome)
                $('#peopleform #cpf').val(pessoas.cpf)
                $('#peopleform #rg').val(pessoas.rg)
                $('#peopleform #data_nascimento').val(formatDate(pessoas.data_nascimento.date))
            }
            if (response.data.estados !== undefined) {
                let estados = response.data.estados
                $('#peopleform #uf').val(estados.uf)
            }
            if (response.data.enderecos !== undefined) {
                let enderecos = response.data.enderecos
                $('#peopleform #cep').val(enderecos.cep)
                $('#peopleform #endereco').val(enderecos.endereco)
                $('#peopleform #numero').val(enderecos.numero)
            }
            if (response.status) {
                $('#loadpreloaddelete').fadeOut('slow').queue(function () {
                    $('#registerModal').modal('toggle')
                    $("#datatable tbody tr td a").removeClass('disabled')
                    $(this).dequeue()
                })
            }
        },
        error: function (error) {
            console.log(error)
        }
    });
}