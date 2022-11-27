<!DOCTYPE html>
<html>

<head>
    <title>Challenger Webdec MVC</title>
    <meta name="base_url" content="{{APP['BASE_URL'] ?? 'localhost'}}">
    <meta name="home_redirect" content="{{APP['HOME_REDIRECT'] ?? ''}}">
    <meta name="csrf" content="{{$csrf ?? null}}">
    <meta name="viewport" content="width=device-width,initial-scale=1">    
    <link href="{{APP['BASE_URL'] ?? 'localhost'}}/public/assets/bootstrap502/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
    <link href="{{APP['BASE_URL'] ?? 'localhost'}}/public/css/style.css?t={{time()}}" rel="stylesheet">
</head>

<body>
    <div id="loadpreload">
        <img width="50" src="{{APP['BASE_URL'] ?? 'localhost'}}/public/img/load.svg">
    </div>
    <div id="msgload">
        <div class="alert alert-primary" role="alert"></div>
    </div>
    <div id="authform" class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="{{APP['BASE_URL'] ?? 'localhost'}}/public/img/logo.png" class="brand_logo" alt="Logo">
                    </div>
                </div>
                <div class="d-flex justify-content-center form_container">
                    <form id="auth" onSubmit="auth(); return false">
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="username" class="form-control input_user" placeholder="usuario"
                                required="required">
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password" id="password" class="form-control input_pass"
                                placeholder="senha" required="required">
                            <div class="input-group-append">
                                <span class="input-group-text"><i id="togglePassword" class="fas fa-eye"></i></span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3 login_container">
                            <button type="submit" name="button" class="btn login_btn">Acessar</button>
                        </div>
                    </form>
                </div>
                <div class="mt-4">
                    <div class="d-flex justify-content-center links">
                        Não tem uma conta? <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal"
                            class="ml-2">Inscrever-se</a>
                    </div>
                    <div class="d-flex justify-content-center links">
                        <a href="#">Esqueceu sua senha?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">Crie sua conta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="registerform" onSubmit="register(); return false">
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="username" class="form-control input_user" placeholder="usuario"
                                required="required">
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password" id="passwordRegister" class="form-control input_pass"
                                placeholder="senha" required="required">
                            <div class="input-group-append">
                                <span class="input-group-text"><i id="togglePasswordRegister"
                                        class="fas fa-eye"></i></span>
                            </div>
                        </div>
                        <button id="submit_reg" type="submit" class="btn btn-primary">Enviar</button>
                        <div id="loadpreloadreg">
                            <img width="30" src="{{APP['BASE_URL'] ?? 'localhost'}}/public/img/load.svg">
                        </div>
                    </form>
                    <div id="msgloadreg">
                        <div class="alert alert-primary" role="alert"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{APP['BASE_URL'] ?? 'localhost'}}/public/assets/jquery361.min.js"></script>
    <script src="{{APP['BASE_URL'] ?? 'localhost'}}/public/assets/bootstrap502/js/bootstrap.min.js"></script>
    <script src="{{APP['BASE_URL'] ?? 'localhost'}}/public/js/auth.js?t={{time()}}"></script>
</body>

</html>