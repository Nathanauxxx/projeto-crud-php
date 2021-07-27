<?php

require 'banco.php';

$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (null == $id) {
    header("Location: index.php");
}

if (!empty($_POST)) {

    $nomeErro = null;
    $cpfErro = null;
    $telefoneErro = null;
    $emailErro = null;

    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];

    //Validação
    $validacao = true;
    if (empty($nome)) {
        $nomeErro = 'Por favor digite o nome!';
        $validacao = false;
    }

    if (empty($email)) {
        $emailErro = 'Por favor digite o email!';
        $validacao = false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErro = 'Por favor digite um email válido!';
        $validacao = false;
    }

    if (empty($cpf)) {
        $cpfErro = 'Por favor digite o CPF!';
        $validacao = false;
    }

    if (empty($telefone)) {
        $telefoneErro = 'Por favor digite o telefone!';
        $validacao = false;
    }



    // atualizar informação
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE cliente  set nome = ?, cpf = ?, telefone = ?, email = ? WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome, $cpf, $telefone, $email, $id));
        Banco::desconectar();
        header("Location: index.php");
    }
} else {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM cliente where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $nome = $data['nome'];
    $cpf = $data['cpf'];
    $telefone = $data['telefone'];
    $email = $data['email'];
    Banco::desconectar();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">

    <title>Atualizar Cliente</title>
</head>

<body>
<div>

    <div>
        <div>
            <div>
                <h3> Atualizar Cliente </h3>
            </div>
            <div>
                <form action="atualizar.php?id=<?php echo $id ?>" method="post">

                    <div <?php echo !empty($nomeErro) ? 'error' : ''; ?>">
                        <label>Nome</label>
                        <div>
                            <input name="nome" size="50" type="text" placeholder="Nome"
                                   value="<?php echo !empty($nome) ? $nome : ''; ?>">
                            <?php if (!empty($nomeErro)): ?>
                                <span><?php echo $nomeErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div <?php echo !empty($cpfErro) ? 'error' : ''; ?>">
                        <label>CPF</label>
                        <div>
                            <input name="cpf" class="form-control" size="80" type="text" placeholder="CPF"
                                   value="<?php echo !empty($cpf) ? $cpf : ''; ?>">
                            <?php if (!empty($cpfErro)): ?>
                                <span class="text-danger"><?php echo $cpfErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div <?php echo !empty($telefoneErro) ? 'error' : ''; ?>">
                        <label>Telefone</label>
                        <div>
                            <input name="telefone" size="30" type="text" placeholder="Telefone"
                                   value="<?php echo !empty($telefone) ? $telefone : ''; ?>">
                            <?php if (!empty($telefoneErro)): ?>
                                <span><?php echo $telefoneErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div <?php echo !empty($emailErro) ? 'error' : ''; ?>">
                        <label>Email</label>
                        <div>
                            <input name="email" size="40" type="text" placeholder="Email"
                                   value="<?php echo !empty($email) ? $email : ''; ?>">
                            <?php if (!empty($emailErro)): ?>
                                <span><?php echo $emailErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

      

                    <br/>
                    <div>
                        <button type="submit">Atualizar</button>
                        <a href="index.php" type="btn">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>

</html>