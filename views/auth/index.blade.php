<!DOCTYPE html>
<html>
<head>
    <title>Challenger Webdec MVC</title>
    <link href="{{APP['BASE_URL'] ?? 'localhost'}}/public/assets/bootstrap502/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
    <link href="{{APP['BASE_URL'] ?? 'localhost'}}/public/css/style.css" rel="stylesheet">
</head>
<body>
    <div id="authform" class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="{{APP['BASE_URL'] ?? 'localhost'}}/public/img/logo.png" class="brand_logo" alt="Logo">
                    </div>
                </div>
                <div class="d-flex justify-content-center form_container">
                    <form>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="email" name="" class="form-control input_user" value="" placeholder="usuario">
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="" class="form-control input_pass" value="" placeholder="senha">
                        </div>
                        <div class="d-flex justify-content-center mt-3 login_container">
                            <button type="button" name="button" class="btn login_btn">Acessar</button>
                        </div>
                    </form>
                </div>
                <div class="mt-4">
                    <div class="d-flex justify-content-center links">
                        Não tem uma conta? <a href="#" class="ml-2">Inscrever-se</a>
                    </div>
                    <div class="d-flex justify-content-center links">
                        <a href="#">Esqueceu sua senha?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{APP['BASE_URL'] ?? 'localhost'}}/public/assets/jquery361.min.js"></script>
    <script src="{{APP['BASE_URL'] ?? 'localhost'}}/public/js/auth.js"></script>
</body>
</html>