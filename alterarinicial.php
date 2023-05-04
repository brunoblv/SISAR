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
                    <input type="text" class="form-control form-control-sm" id="numsql" name="numsql" value="<?php echo htmlspecialchars($numsql); ?>">
                </div>
                <div class="col col-3">
                    <label for="tipo" class="form-label">Tipo:</label>
                    <input type="text" class="form-control form-control-sm" id="tipo" name="tipo"  maxlenght="1" value="<?php echo htmlspecialchars($tipo); ?>">
                </div>
                <div class="col col-3">
                    <label for="req" class="form-label">REQ:</label>
                    <input type="text" class="form-control form-control-sm" id="req" name="req" maxlenght="3" value="<?php echo htmlspecialchars($req); ?>">
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
                    <label for="dataprotocolo" class="form-label">Data do Protocolo pelo interessado:</label>
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
                        <option value="0">Não</option>
                    </select>
                    <script>
                        var opcao = '<?php echo $stand ?>';

                        var stand = document.getElementById("stand");
                        if (opcao == '1') {
                            stand.value = 1;
                        } else {
                            stand.value = 0;
                        }
                    </script>
                </div>
                <div class="col col-3">
                    <label for="outorga" class="form-label">Há pedido de Outorga Onerosa?</label>
                    <select class="form-select" aria-label="Default select example" name="outorga" id="outorga">
                        <option selected></option>
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                    <script>
                        var opcao = '<?php echo $outorga ?>';

                        var stand = document.getElementById("outorga");
                        if (opcao == '1') {
                            stand.value = 1;
                        } else {
                            stand.value = 0;
                        }
                    </script>
                </div>
                <div class="col col-3">
                    <label for="cepac" class="form-label">Há pedido de CEPAC?</label>
                    <select class="form-select" aria-label="Default select example" name="cepac" id="cepac">
                        <option selected></option>
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                    <script>
                        var opcao = '<?php echo $cepac ?>';

                        var cepac = document.getElementById("cepac");
                        if (opcao == '1') {
                            cepac.value = 1;
                        } else {
                            cepac.value = 0;
                        }
                    </script>
                </div>
                <div class="col col-3">
                    <label for="ou" class="form-label">Há pedido de Operação urbana?</label>
                    <select class="form-select" aria-label="Default select example" name="ou" id="ou">
                        <option selected></option>
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                    <script>
                        var opcao = '<?php echo $ou ?>';

                        var ou = document.getElementById("ou");
                        if (opcao == '1') {
                            ou.value = 1;
                        } else {
                            ou.value = 0;
                        }
                    </script>
                </div>
                <div class="col col-3">
                    <label for="aiu" class="form-label">Há pedido de AIU?</label>
                    <select class="form-select" aria-label="Default select example" name="aiu" id="aiu">
                        <option selected></option>
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                    <script>
                        var opcao = '<?php echo $aiu ?>';

                        var aiu = document.getElementById("aiu");
                        if (opcao == '1') {
                            aiu.value = 1;
                        } else {
                            aiu.value = 0;
                        }
                    </script>
                </div>
                <div class="col col-3">
                    <label for="rivi" class="form-label">Há pedido de RIVI?</label>
                    <select class="form-select" aria-label="Default select example" name="rivi" id="rivi">
                        <option selected></option>
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                    <script>
                        var opcao = '<?php echo $rivi ?>';

                        var rivi = document.getElementById("rivi");
                        if (opcao == '1') {
                            rivi.value = 1;
                        } else {
                            rivi.value = 0;
                        }
                    </script>
                </div>
                <div class="col col-3">
                    <label for="aquecimento" class="form-label">Há pedido de Aquecimento Solar?</label>
                    <select class="form-select" aria-label="Default select example" name="aquecimento" id="aquecimento">
                        <option selected></option>
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                    <script>
                        var opcao = '<?php echo $aquecimento ?>';

                        var aquecimento = document.getElementById("aquecimento");
                        if (opcao == '1') {
                            aquecimento.value = 1;
                        } else {
                            aquecimento.value = 0;
                        }
                    </script>
                </div>
                <div class="col col-3">
                    <label for="gerador" class="form-label">Há pedido de Polo gerador de tráfego?</label>
                    <select class="form-select" aria-label="Default select example" name="gerador" id="gerador">
                        <option selected></option>
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                </div>
                <script>
                    var opcao = '<?php echo $gerador ?>';

                    var gerador = document.getElementById("gerador");
                    if (opcao == '1') {
                        gerador.value = 1;
                    } else {
                        gerador.value = 0;
                    }
                </script>                
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
            <button type="button" class="btn btn-dark ml-auto" name="cancelar" id="cancelar">Cancelar</button>
        </form>
    </div>
</div>