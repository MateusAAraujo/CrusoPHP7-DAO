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
            
            $this->setData($results[0]);
            
            /**** REMOVENDO ESTE TRECHO DE CÓDIGO PARAZ UM MÉTODO setData() ****
            $row = $results[0];
            
            $this->setIdusuario($row["idusuario"]);
            $this->setDeslogin($row["deslogin"]);
            $this->setDessenha($row["dessenha"]);
            $this->setDtcadastro(new DateTime($row["dtcadastro"])); 
             */
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
                        
            /**** REMOVENDO ESTE TRECHO DE CÓDIGO PARAZ UM MÉTODO setData() ****
            $row = $results[0];
            
            $this->setIdusuario($row['idusuario']);
            $this->setDeslogin($row['deslogin']);
            $this->setDessenha($row['dessenha']);
            $this->setDtcadastro(new DateTime($row['dtcadastro']));
            */
            
            $this->setData($results[0]);
            
            else:
                throw new Exception("Login e/ou Senha Inválido(s)!");
        endif;
    }
    
    //Método criado para possibilitar reutilização de código
    public function setData($data){
        
        $this->setIdusuario($data['idusuario']);
        $this->setDeslogin($data['deslogin']);
        $this->setDessenha($data['dessenha']);
        $this->setDtcadastro(new DateTime($data['dtcadastro']));
    }
    
    //Método para inserção de dados no BD, usando procedures
    public  function insert(){
        
        $sql = new Sql();
        
        $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
            ':LOGIN' => $this->getDeslogin(),
            ':PASSWORD' => $this->getDessenha()            
        ));
        
        if(count($results) > 0):
            $this->setData($results[0]);
            
        endif;
    }
    
    //Método para atualização de dados no BD
    public function update($login, $password){
        
        $this->setDeslogin($login);
        $this->setDessenha($password);
        
        $sql = new Sql();
        
        $sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
            ':LOGIN'=>$this->getDeslogin(),
            ':PASSWORD'=> $this->getDessenha(),
            ':ID'=>$this->getIdusuario()
        ));
    }
    
    //Método para excluir dados do DB
    public function delete(){
        
        $sql = new Sql();
        
        $sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
            ':ID'=>$this->getIdusuario()
            
        ));
        
        $this->setIdusuario(0);
        $this->setDeslogin("");
        $this->setDessenha("");
        $this->setDtcadastro(new DateTime());
    }

    //Método construtor para inserção de dados no BD
    //Parâmentros setado com "" (Não sendo obrigatório enviar parâmetros na chamada do método
    public function __construct($login = "", $password = "") {
        $this->setDeslogin($login);
        $this->setDessenha($password);
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

