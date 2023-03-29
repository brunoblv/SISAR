<div class="card bg-light mb-3">
    <div class="card-header">
        <strong>Dados Iniciais</strong>
    </div>
    <div class="card-body">
        <form class="need-validation" novalidade method="POST" action="updatecadastroinicial.php" autocomplete="off">
            <div class="form-row">                               
                    <input type="text" class="form-control form-control-sm" id="id" name="id" value="<?php echo htmlspecialchars($controleinterno); ?>" hidden>                
                <div class="col col-3">
                    <label for="sei" class="form-label sei">Nº SEI:</label>
                    <input type="text" class="form-control form-control-sm" id="sei" name="sei" value="<?php echo htmlspecialchars($sei); ?>">
                </div>
                <div class="col col-3">
                    <label for="numsql" class="form-label sql">SQL:</label>
                    <input type="text" class="form-control form-control-sm" id="numsql" name="numsql" required="required" value="<?php echo htmlspecialchars($numsql); ?>">
                </div>
                <div class="col col-3">
                    <label for="tipo" class="form-label">Tipo:</label>
                    <input type="text" class="form-control form-control-sm" id="tipo" name="tipo" value="<?php echo htmlspecialchars($tipo); ?>">
                </div>
                <div class="col col-3">
                    <label for="req" class="form-label">REQ:</label>
                    <input type="text" class="form-control form-control-sm" id="req" name="req" value="<?php echo htmlspecialchars($req); ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="col col-3">
                    <label for="aprova" class="form-label digital">N° Aprova Digital:</label>
                    <input type="text" class="form-control form-control-sm" id="digital" name="digital" value="<?php echo htmlspecialchars($aprovadigital); ?>">
                </div>
                <div class="col col-3">
                    <label for="fisico" class="form-label fisico">Nº Processo Físico:</label>
                    <input type="text" class="form-control form-control-sm" id="fisico" name="fisico" value="<?php echo htmlspecialchars($fisico); ?>">
                </div>
                <div class="col col-3">
                    <label for="dataprotocolo" class="form-label">Data do Protocolo:</label>
                    <input type="text" class="form-control form-control-sm" id="dataprotocolo" name="dataprotocolo" value="<?php echo htmlspecialchars($inverted_date); ?>">
                </div>
                <div class="col col-3">
                    <label for="tipoprocesso" class="form-label">Tipo de processo:</label>
                    <select class="form-select" aria-label="Default select example" name="tipoprocesso" id="tipoprocesso">
                        <option selected></option>
                        <option value="1">Próprio de SMUL</option>
                        <option value="2">Múltiplas Interfaces</option>
                    </select>

                    <script>
                        var opcao = '<?php echo $tipoprocesso ?>';

                        var tipoprocesso = document.getElementById("tipoprocesso");
                        if (opcao == '1') {
                            tipoprocesso.value = 1;
                        } else {
                            tipoprocesso.value = 2;
                        }
                    </script>


                </div>
            </div>
            <div class="form-row">
                <div class="col col-3">
                    <label for="alv1" class="form-label">Tipo de Alvará:</label>
                    <select class="form-select" aria-label="Default select example" name="alv1" id="alv1">
                        <option selected></option>
                        <option value="1">Nada</option>
                        <option value="2">Projeto Modificativo</option>
                    </select>

                    <script>
                        var opcao = '<?php echo $tipoalvara1 ?>';

                        var alv1 = document.getElementById("alv1");
                        if (opcao == '1') {
                            alv1.value = 1;
                        } else {
                            alv1.value = 2;
                        }
                    </script>
                </div>
                <div class="col col-3">
                    <label for="alv2" class="form-label">Tipo de Alvará 2:</label>
                    <select class="form-select" aria-label="Default select example" name="alv2" id="alv2">
                        <option selected></option>
                        <option value="1">Alvará de Aprovação</option>
                        <option value="2">Alvará de Aprovação e Execução</option>
                        <option value="3">Alvará de Execução</option>
                    </select>

                    <script>
                        var opcao = '<?php echo $tipoalvara2; ?>'

                        var alv2 = document.getElementById("alv2");

                        switch (opcao) {
                            case '1':
                                alv2.value = 1;
                                break;
                            case '2':
                                alv2.value = 2;
                                break;
                            case '3':
                                alv2.value = 3;
                                break;
                        }
                    </script>
                </div>
                <div class="col col-3">
                    <label for="alv3" class="form-label">Tipo de Alvará 3:</label>
                    <select class="form-select" aria-label="Default select example" name="alv3" id="alv3">
                        <option selected></option>
                        <option value="1">Edificação Nova</option>
                        <option value="2">Reforma</option>
                        <option value="3">Requalificação</option>
                        <option value="4">Requalificação associada a reforma</option>
                    </select>

                    <script>
                        var opcao = '<?php echo $tipoalvara3; ?>'

                        var alv3 = document.getElementById("alv3");

                        switch (opcao) {
                            case '1':
                                alv3.value = 1;
                                break;
                            case '2':
                                alv3.value = 2;
                                break;
                            case '3':
                                alv3.value = 3;
                                break;
                            case '4':
                                alv3.value = 4;
                                break;
                        }
                    </script>
                </div>
                <div class="col col-3">
                    <label for="stand" class="form-label">Há pedido de stand de vendas?:</label>
                    <select class="form-select" aria-label="Default select example" name="stand" id="stand">
                        <option selected></option>
                        <option value="1">Sim</option>
                        <option value="2">Não</option>
                    </select>
                    <script>
                        var opcao = '<?php echo $stand ?>';

                        var stand = document.getElementById("stand");
                        if (opcao == '1') {
                            stand.value = 1;
                        } else {
                            stand.value = 2;
                        }
                    </script>


                </div>
            </div>
            <div class="form-row">
                <div class="col col-3">
                    <label for="status" class="form-label">Status:</label>
                    <select class="form-select" aria-label="Default select example" name="status" id="status">
                        <option selected></option>
                        <option value="1">Análise de Admissibilidade</option>
                        <option value="2">Inadmissível/Via ordinária</option>
                        <option value="3">Em análise</option>
                        <option value="4">Deferidos</option>
                        <option value="5">Indeferidos</option>
                        <option value="6">Inválido</option>
                    </select>

                    <script>
                        var opcao = '<?php echo $sts; ?>'

                        var sts = document.getElementById("status");

                        switch (opcao) {
                            case '1':
                                sts.value = 1;
                                break;
                            case '2':
                                sts.value = 2;
                                break;
                            case '3':
                                sts.value = 3;
                                break;
                            case '4':
                                sts.value = 4;
                                break;
                            case '5':
                                sts.value = 5;
                                break;
                            case '6':
                                sts.value = 6;
                                break;
                        }
                    </script>
                </div>
                <div class="col col-3">
                    <label for="descstatus" class="form-label">Descrição de Status:</label>
                    <input type="text" class="form-control form-control-sm" id="descstatus" name="descstatus" required="required" value="<?php echo htmlspecialchars($descstatus); ?>">
                </div>
                <div class="col col-3">
                    <label for="decreto" class="form-label">Anterior ao Decreto ou após novo Decreto?:</label>
                    <select class="form-select" aria-label="Default select example" name="decreto" id="decreto">
                        <option selected></option>
                        <option value="1">Anterior</option>
                        <option value="2">Posterior</option>
                    </select>
                    <script>
                        var opcao = '<?php echo $decreto ?>';

                        var decreto = document.getElementById("decreto");
                        if (opcao == '1') {
                            decreto.value = 1;
                        } else {
                            decreto.value = 2;
                        }
                    </script>
                </div>
                <div class="col col-3">
                    <label for="dataad" class="form-label">Data de início Admissibilidade:</label>
                    <input type="text" class="form-control form-control-sm" id="dataad" name="dataad" value='<?php echo htmlspecialchars($inverted_datead); ?>'>
                </div>
            </div>
            <div class="row">
                <div class=".col-12 .col-md-8">
                    <label class="form-label" for="obs">Observação:</label>
                    <textarea class="form-control form-control-sm textarea" id="obs" rows="" name="obs" maxlength="300"><?php echo htmlspecialchars($obs); ?></textarea>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary" name="salvar">Atualizar</button>
            <button type="submit" class="btn btn-dark ml-auto" name="cancelar" id="cancelar">Cancelar</button>
        </form>
    </div>
</div>