<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Curso Completo de PHP 7</title>
    </head>
    <body>
        <?php
           require_once ("config.php"); 
           
           $sql = new Sql();
           
           $usuarios = $sql->select("SELECT * FROM tb_usuarios");
           
           echo json_encode($usuarios);
                   
        ?>
    </body>
</html>
