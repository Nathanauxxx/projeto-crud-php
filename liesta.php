<?php
require 'banco.php';
$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (null == $id) {
    header("Location: index.php");
} else {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM cliente where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Banco::desconectar();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Consultar Cliente</title>
</head>

<body>
<div>
    <div>
        <div>
            <div>
                <h3>Consultar Cliente</h3>
            </div>
            <div>
                <div>
                    <div>
                        <label>Nome</label>
                        <div>
                            <label>
                                <?php echo $data['nome']; ?>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label>CPF</label>
                        <div>
                            <label>
                                <?php echo $data['cpf']; ?>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label>Telefone</label>
                        <div>
                            <label>
                                <?php echo $data['telefone']; ?>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label>Email</label>
                        <div>
                            <label>
                                <?php echo $data['email']; ?>
                            </label>
                        </div>
                    </div>

                    
                    <br/>
                    <div class="form-actions">
                        <a href="index.php" type="btn">Voltar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>