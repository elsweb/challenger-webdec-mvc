<div class="modal fade" id="registerModal" tabindex="-1"
    aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Cadastro</h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="peopleform" onSubmit="save(); return false">
                    <input type="hidden" name="id" id="id">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text">Nome*</span>
                        </div>
                        <input type="text" name="nome" id="nome"
                            class="form-control input_user"
                            required="required">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text">Nascimento*</span>
                        </div>
                        <input type="date" name="data_nascimento"
                            id="data_nascimento"
                            class="form-control input_user" required="required">
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text">CPF*</span>
                                </div>
                                <input type="text" name="cpf" id="cpf"
                                    class="form-control input_pass"
                                    required="required">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text">RG*</span>
                                </div>
                                <input type="text" name="rg" id="rg"
                                    class="form-control input_pass"
                                    required="required">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text">Estado*</span>
                                </div>
                                <input type="text" name="uf" id="uf"
                                    class="form-control input_pass"
                                    required="required" maxlength="2">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text">CEP*</span>
                                </div>
                                <input type="text" name="cep" id="cep"
                                    class="form-control input_pass"
                                    required="required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-8">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text">Rua*</span>
                                </div>
                                <input type="text" name="endereco" id="endereco"
                                    class="form-control input_pass"
                                    required="required">
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text">N°*</span>
                                </div>
                                <input type="text" name="numero" id="numero"
                                    class="form-control input_pass"
                                    required="required">
                            </div>
                        </div>
                    </div>
                    <a href="javascript:clearForm('peopleform');" id="btnclear"
                        class="btn btn-primary">Limpar</a>
                    <button id="submit_reg" type="submit" class="btn
                        btn-primary">Salvar</button>
                    <div id="loadpreloadreg">
                        <img width="30" src="{{APP['BASE_URL'] ??
                            'localhost'}}/public/img/load.svg">
                    </div>
                </form>
                <div id="msgloadreg">
                    <div class="alert alert-primary" role="alert"></div>
                </div>
            </div>
        </div>
    </div>
</div>