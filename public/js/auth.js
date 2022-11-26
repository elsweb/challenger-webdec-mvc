$(document).ready(function () {

});
function auth() {
    let base = $('meta[name=base_url]').attr('content')
    $('#loadpreload').fadeIn('slow')
    $.ajax({
        url: `${base}/login`,
        type: "POST",
        data: $('#auth').serialize(),
        success: function (response) {
            $('#msgload .alert').html(response.msg)
            if (response.status) {
                $('#loadpreload').fadeOut('slow').queue(function () {
                    $('#msgload').fadeIn('slow')
                    $(this).dequeue()
                }).queue(function () {
                    setTimeout(function () {
                        window.location.replace(base)
                    }, 3000)
                    $(this).dequeue()
                })
            } else {
                $('#loadpreload').fadeOut('slow').queue(function () {
                    $('#msgload').fadeIn('slow')
                    $(this).dequeue()
                })
            }
        },
        error: function (error) {
            $('#msgload .alert').html("Ops algum erro aconteceu. tente novamente mais tarde.")
            $('#loadpreload').fadeOut('slow').queue(function () {
                $('#msgload').fadeIn('slow')
                $(this).dequeue()
            })
        }
    });
}