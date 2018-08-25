<?php
    //criando classe extendida do PDO (Herança) para auxiliar na conexão ao bd:dbphp7
    //A classe poderia ter qualquer nome, nomeamos Sql, por conveniência.
    class Sql extends PDO {
        
        //declarando atributo privado para conexão bd
        private $conn;

        //criando método construtor para a conexão ao bd.
        public function __construct() {
            /* estânciando a conexão: Caso tivessemos mais servidores ou mais BD (por exemplo), 
             * poderíamos passar os parâmetros pelo método construtor new Sql() */
            $this->conn = new PDO("mysql:host=localhost;dbname=dbphp7", "root", "");
        }
        
        //Método para reutilização do código para executar comando no BD.
        private function setParams($statement, $parameters = array()) {
            
            //Percorrendo o BD e recuperando
            foreach ($parameters as $key => $value) {
                //chamando método setParam, para atualizar dados no bd.
                $this->setParam($statement, $key, $value);
            }
        }
        
        /*Executando comandos com um parâmetro no BD. Por ter apenas um parâmetro, podemos
         * receber os parâmetros no próprio método. Ou seja, passamos um parâmetro e
         * recebemos dois */
        private function setParam($statement, $key, $value) {
            
            //bind = associa (liga) parâmetro com o valor passado
            $statement->bindParam($key, $value);
        }

        //Executando comandos no BD.
        public function query($rawQuery, $params = array()) {
            //criando variável e atribuindo o resultado da consulta ao DB.
            $stmt = $this->conn->prepare($rawQuery);

            //chamando método setParam
            $this->setParams($stmt, $params);
            //executando a query
            $stmt->execute();
            //retornando
            return $stmt;
        }

        //Criando método select, que retorna um array()
        public function select($rawQuery, $params = array()): array {
            //criando variável e atribuindo retorno do comando select
            $stmt = $this->query($rawQuery, $params);
            //retornando somente os dados associativos sem os indices
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

}
?>
   