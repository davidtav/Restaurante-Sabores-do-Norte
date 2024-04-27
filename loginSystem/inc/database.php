<?php 

class database
{
    //esse método realiza a conexão e a prevenção de SQL injection por meio da parametrização dos dados de entrada
    public function query($sql,$params=[])
    {
        try {
            //conexão e comunicação com o banco de dados
            $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASSWORD);
            $pdo ->setAttribute(\PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // comando ou statement(stmt)
            $comando = $pdo->prepare($sql);
            $comando->execute($params);
            $result=$comando->fetchAll(PDO::FETCH_CLASS);
            //devolve resultados
            return[
                'status' =>'success',
                'data' => $result
            ];
        } catch (\PDOException $error) {
            //devolve o erro
            return[
               'status' => 'error',
               'data' => $error->getMessage()
            ];
        }
    }
}