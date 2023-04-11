<div class="card bg-light mb-3">
    <form class="need-validation" novalidade method="POST" action="updatedistribuicao.php" autocomplete="off">
        <div class="card-header">
            <strong>Dados de Distribuição</strong>
        </div>
        <div class="card-body">
            <div class="form-row">
            <input type="text" class="form-control form-control-sm" id="id" name="id" value="<?php echo htmlspecialchars($controleinterno); ?>" hidden>  
                <div class="col col-3">
                    <label for="tec" class="form-label">Técnico de ATECC responsável:</label>
                    <select class="form-select" id="tec" required name="tec">
                        <?php $query = $conn->query("SELECT nome, cargo FROM usuarios WHERE cargo ='TEC' ORDER BY NOME ASC"); ?>
                        <?php while ($reg = $query->fetch_array()) { ?>
                            <option value="<?php echo $reg['nome']; ?>" <?php if ($reg['nome'] == $tec) echo 'selected'; ?>>
                                <?php echo $reg['nome']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col col-3">
                    <label for="tectroca" class="form-label">Técnico de ATECC responsável após troca:</label>
                    <select class="form-select" id="tectroca" required name="tectroca">
                        <?php $query = $conn->query("SELECT nome, cargo FROM usuarios WHERE cargo ='TEC' OR cargo ='' ORDER BY NOME ASC"); ?>
                        <?php while ($reg = $query->fetch_array()) { ?>
                            <option value="<?php echo $reg['nome']; ?>" <?php if ($reg['nome'] == $tectroca) echo 'selected'; ?>>
                                <?php echo $reg['nome']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col col-3">
                    <label for="adm" class="form-label">ADM de ATECC responsável:</label>
                    <select class="form-select" id="adm" required name="adm">
                        <?php $query = $conn->query("SELECT nome, cargo FROM usuarios WHERE cargo ='adm' OR cargo ='' ORDER BY NOME ASC"); ?>
                        <?php while ($reg = $query->fetch_array()) { ?>
                            <option value="<?php echo $reg['nome']; ?>" <?php if ($reg['nome'] == $adm) echo 'selected'; ?>>
                                <?php echo $reg['nome']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col col-3">
                    <label for="admsubst" class="form-label">ADM de ATECC substituto:</label>
                    <select class="form-select" id="admsubst" required name="admsubst">
                        <?php $query = $conn->query("SELECT nome, cargo FROM usuarios WHERE cargo ='adm' OR cargo ='' ORDER BY NOME ASC"); ?>
                        <?php while ($reg = $query->fetch_array()) { ?>
                            <option value="<?php echo $reg['nome']; ?>" <?php if ($reg['nome'] == $admsubst) echo 'selected'; ?>>
                                <?php echo $reg['nome']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="col col-3">
                    <label for="admsubst2" class="form-label">ADM de ATECC substituto do substituto:</label>
                    <select class="form-select" id="admsubst2" required name="admsubst2">
                        <?php $query = $conn->query("SELECT nome, cargo FROM usuarios WHERE cargo ='adm' OR cargo ='' ORDER BY NOME ASC"); ?>
                        <?php while ($reg = $query->fetch_array()) { ?>
                            <option value="<?php echo $reg['nome']; ?>" <?php if ($reg['nome'] == $admsubst2) echo 'selected'; ?>>
                                <?php echo $reg['nome']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col col-3">
                    <label for="fisico" class="form-label">Observações 1:</label>
                    <input type="text" class="form-control form-control-sm" id="obs1" name="obs1" value="<?php echo htmlspecialchars($obs1); ?>">
                </div>
                <div class="col col-3">
                    <label for="aprova" class="form-label">Observações 2:</label>
                    <input type="text" class="form-control form-control-sm" id="obs2" name="obs2" value="<?php echo htmlspecialchars($obs2); ?>">
                </div>
                <div class="col col-3">
                    <label for="baixa" class="form-label">Verificada baixa no pagamento das guias?:</label>
                    <select class="form-select" id="baixa" required name="baixa" value="<?php echo htmlspecialchars($baixa); ?>">
                        <option></option>
                        <option value="1">Sim</option>
                        <option value="2">Isento</option>
                        <option value="3">Sim, vinculado</option>
                        <option value="4">Isento, vinculado</option>
                    </select>
                    <script>
                        var opcao = '<?php echo $baixa; ?>'

                        var baixa = document.getElementById("baixa");

                        switch (opcao) {
                            case '1':
                                baixa.value = 1;
                                break;
                            case '2':
                                baixa.value = 2;
                                break;
                            case '3':
                                baixa.value = 3;
                                break;
                            case '4':
                                baixa.value = 4;
                                break;
                        }
                    </script>

                </div>
            </div>
            <div class="form-row">
                <div class="col col-3">
                    <label for="pi" class="form-label">Processo relacionado incomum:</label>
                    <input type="text" class="form-control form-control-sm" id="pi" name="pi" value="<?php echo htmlspecialchars($pi); ?>">
                </div>
                <div class="col col-3">
                    <label for="assuntopi" class="form-label">Assunto do processo relacionado incomum:</label>
                    <input type="text" class="form-control form-control-sm" id="assuntopi" name="assuntopi" value="<?php echo htmlspecialchars($assuntopi); ?>">
                </div>
            </div>
            <br>
            <div class="form-row">
                <div class="col col-3">
                    <button type="submit" class="btn btn-primary" name="salvar">Atualizar</button>
                    <button type="button" class="btn btn-dark ml-auto" name="cancelar" id="cancelar">Cancelar</button>
                </div>
            </div>
        </div>
    </form>
</div>