$(document).ready(function () {

});
function auth() {
    let base = $('meta[name=base_url]').attr('content')
    let csrf = $('meta[name=csrf]').attr('content')
    $('#loadpreload').fadeIn('slow')
    $.ajax({
        url: `${base}/login`,
        type: "POST",
        data: $('#auth').serialize(),
        headers: {
            'X-CSRF-TOKEN': csrf,
        },
        success: function (response) {
            $('#msgload .alert').html(response.msg)
            /*reload token case not accept login*/
            if (response.token !== undefined) {
                $('meta[name=csrf]').attr('content', response.token);
            }
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
                }).queue(function () {
                    setTimeout(() => {
                        $('#msgload').fadeOut('slow')
                    }, 5000)
                    $(this).dequeue()
                })
            }
        },
        error: function (error) {
            console.log(error)
            $('#msgload .alert').html("Ops algum erro aconteceu. tente novamente mais tarde.")
            $('#loadpreload').fadeOut('slow').queue(function () {
                $('#msgload').fadeIn('slow')
                $(this).dequeue()
            }).queue(function () {
                setTimeout(() => {
                    $('#msgload').fadeOut('slow')
                }, 5000)
                $(this).dequeue()
            })
        }
    });
}