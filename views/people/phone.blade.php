<!--Phone form-->
<div class="modal fade" id="phoneModal" tabindex="-1"
    aria-labelledby="phoneModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="phoneModalLabel">Cadastro</h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="phoneform" onSubmit="savePhone(); return false">
                    <input type="hidden" name="id" id="pessoas_id">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text">Telefone*</span>
                        </div>
                        <input type="text" name="telefone" id="telefone"
                            class="form-control input_user"
                            required="required">
                    </div>
                    <button id="submit_phone" type="submit" class="btn
                        btn-primary">Salvar</button>
                    <div id="loadpreloadphone">
                        <img width="30" src="{{APP['BASE_URL'] ??
                            'localhost'}}/public/img/load.svg">
                    </div>
                </form>
                <div id="msgloadphone">
                    <div class="alert alert-primary" role="alert"></div>
                </div>
            </div>
        </div>
    </div>
</div>