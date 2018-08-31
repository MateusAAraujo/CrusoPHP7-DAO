<?php

/**
 * Description of Usuario
 * @author mateus
 */
class Usuario {
    
    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;
    
    public function getIdusuario(){
        return $this->idusuario;
    }
    
    public function setIdusuario($value){
        $this->idusuario = $value;
    }
    
    public function getDeslogin(){
        return $this->deslogin;
    }
    
    public function setDeslogin($value){
        $this->deslogin = $value;
    }
    
    public function getDessenha(){
        return $this->dessenha;
    }
    
    public function setDessenha($value){
        $this->dessenha = $value;
    }
    
    public function getDtcadastro(){
        return $this->dtcadastro;
    }
    
    public function setDtcadastro($value){
        $this->dtcadastro = $value;
    }
    
    //Método que retorna apenas um usuário cadastrado no BD
    public function loadById($id){
        //estânciando a class Sql()
        $sql = new Sql();
        
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", 
                array(":ID"=>$id));
        
        
        //if(isset($results[0]){}
        if(count($results) > 0){
            
            $row = $results[0];
            
            $this->setIdusuario($row["idusuario"]);
            $this->setDeslogin($row["deslogin"]);
            $this->setDessenha($row["dessenha"]);
            $this->setDtcadastro(new DateTime($row["dtcadastro"]));
        }
    }
    
    //Método que retorna uma lista com todos os usuários cadastrados no BD
    public static function getList(){
        //estânciando a class Sql()
        $sql = new Sql();
        
        return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");
    }
    
    //Método para procurar usuário(s) que contenha $login
    public static function search($login){
      $sql = new Sql();
      return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(':SEARCH'=>"%".$login."%"));
    }
    
    //Método que retorna um usuário pelo login e senha
    public function login($login, $password){
        $sql = new Sql();
        
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
            ":LOGIN"=>$login,
            ":PASSWORD"=>$password
        ));
        
        if(count($results) > 0):
            $row = $results[0];
            
            $this->setIdusuario($row['idusuario']);
            $this->setDeslogin($row['deslogin']);
            $this->setDessenha($row['dessenha']);
            $this->setDtcadastro(new DateTime($row['dtcadastro']));
            
            else:
                throw new Exception("Login e/ou Senha Inválido(s)!");
        endif;
    }


    public function __toString() {
        
        return json_encode(array(
            "idusuario"=>$this->getIdusuario(),
            "deslogin"=> $this->getDeslogin(),
            "dessenha"=> $this->getDessenha(),
            "dtcadastro"=> $this->getDtcadastro()->format("d/m/Y H:i:s")
        ));
    }
}

