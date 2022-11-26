$(document).ready(function () {

});
const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#password");

togglePassword.addEventListener("click", function () {
    const type = password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);
    this.classList.toggle("bi-eye");
});

const togglePasswordRegister = document.querySelector("#togglePasswordRegister");
const passwordRegister = document.querySelector("#passwordRegister");

togglePasswordRegister.addEventListener("click", function () {
    const type = passwordRegister.getAttribute("type") === "password" ? "text" : "password";
    passwordRegister.setAttribute("type", type);
});



function register() {
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
        url: `${base}/register`,
        type: "POST",
        data: $('#registerform').serialize(),
        headers: {
            'X-CSRF-TOKEN': csrf,
        },
        success: function (response) {
            $('#msgloadreg .alert').html(response.msg)
            /*reload token for user login*/
            if (response.token !== undefined) {
                $('meta[name=csrf]').attr('content', response.token);
            }
            if (response.status) {
                $('#registerform').trigger("reset");
                $('#registerModal').modal('toggle');
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
