<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //área reservada para dados sensíveis
    
    $servidor = "";
    $usuario = "";
    $senha = "";
    $banco = "";

    $conexao = new mysqli($servidor, $usuario, $senha, $banco);

    if($conexao->connect_error){
        die("Falha na conexão: " . $conexao->connect_error);
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $fake = $_POST['fake'];
        $conteudo = $_POST['conteudo'];
        $verificado = $_POST['verificado'];
        $justificativa = $_POST['justificativa'];
        $tipo = $_POST['tipo'];

        $md5 = md5($conteudo);
        $sql = "INSERT INTO MENSAGEM (FAKE, CONTEUDO, VERIFICADO, MD5, JUSTIFICATIVA, TIPO) VALUES (?,?,?,?,?,?)";

        $smt = $conexao->prepare($sql);
        $smt ->bind_param("isissi", $fake, $conteudo, $verificado, $md5, $justificativa, $tipo);

        if($smt->execute()){
            echo "Noticia cadastrada!";
        }else{
            echo "Erro ao cadastrar: " . $smt->error;
        }

        $smt->close();
        $conexao->close();
    }else{
        echo "Método de requisição inválido!";
    }
?>