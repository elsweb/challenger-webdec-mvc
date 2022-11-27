function updateRow(data){
    if(window.row !== null){
        window.row.data(data)
    }
    window.row = null /*reset global obj row*/
}
function clearForm(form) {    
    $(`#${form} #id`).val('')
    $(`#${form}`).trigger("reset")
}
function setDataTable(columns, dataset) {
    return $("#datatable").DataTable({
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "Nenhum resultado encontrado",
            "sEmptyTable": "Não há dados disponíveis nesta tabela",
            "sInfo": "Mostrando registros de _START_ a _END_ de um total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros de 0 a 0 de um total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Carregando...",
            "oPaginate": {
                "sFirst": "Primeiro",
                "sLast": "Último",
                "sNext": "Próximo",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Ative para classificar a coluna em ordem crescente",
                "sSortDescending": ": Ative para classificar a coluna em ordem decrescente"
            }
        },
        data: dataset,
        columns: columns,
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');
}
function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    return [year, month, day].join('-');
}

