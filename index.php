<form method="POST">

<h3><span>Faça sua pesquisa digitado o nome</span></h3>

<input type="text" name="campo"/>
<input type="submit" value="Pesquisar">

<form>

<hr>
<?php
if(isset($_POST['campo']) && !empty($_POST['campo'])){
    $campo = addslashes($_POST['campo']);


    try{

        $pdo = new PDO("mysql:dbname=botaoPesquisar;host=localhost","root", "");

        
        $sql ="SELECT id,nome,email FROM usuario WHERE id =:id OR nome =:nome OR email = :email ORDER BY nome ";

        $sql = $pdo->prepare($sql);
        $sql->bindValue(":id",$campo);
        $sql->bindValue(":nome",$campo);
        $sql->bindValue(":email",$campo);

        $sql->execute();

        if($sql->rowCount() > 0){
            $sql = $sql->fetch();
          
          
            echo 'Coluna: ' .$sql['id'].','."Nome: ".$sql['nome'].','. "Email: " .$sql['email'];

        
        }




    }catch(PDOException $ex){
        echo "Falha com o banco ".$ex->getMessage();

    }

}



?>