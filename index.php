<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Curso Completo de PHP 7</title>
    </head>
    <body>
        <?php
           require_once ("config.php"); 
           /*
           //Conexão class Sql(): com select simples
           $sql = new Sql();
           
           $usuarios = $sql->select("SELECT * FROM tb_usuarios");
           
           echo json_encode($usuarios);
           */ 
           
           /*
           //Conexão class Usuario(): Consultando o BD por id chamando o método loadById()
           $root = new Usuario();
           $root->loadById(3);
           
           echo $root;
           */
           
           /*
           //Conexão class Usuario(): Consultando uma lista de usuários com todos os usuários cadastrados no BD
           //Como o método class Usuario() ŕ do tipo static, não é preciso estânciá-lo
           $lista = Usuario::getList();
           
           echo json_encode($lista);
           */
           
           /*
           //carrega um lista de usuarios, buscando pelo $login
           $search = Usuario::search("Jo");
           
           echo json_encode($search);
           */
           
           /*
           //carrega um usuário usando o login e a senha
           $usuario = new Usuario();
           
           $usuario->login("root", "!@#$%");
           
           echo $usuario;
           */
           
           /*
           //Inserindo um usuário novo no BD
           $aluno = new Usuario("aluno", "aluno");
           
           $aluno->insert();
           
           echo $aluno;
           */
           
           /*
           //Atualizando dados no BD
           $usuario = new Usuario();
           
           $usuario->loadById(8);
           
           $usuario->update("professor", "!@#$%¨&*");
           
           echo $usuario;
           */
           
           $usuario = new Usuario();
           
           $usuario->loadById(7);
           
           $usuario->delete();
           
           echo $usuario;
           
           
           
        ?>
    </body>
</html>
