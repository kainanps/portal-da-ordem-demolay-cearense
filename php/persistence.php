<?php

class Persistence
{
    private $conn;
    const HOSTNAME = 'localhost';
    const USERNAME = 'root';
    const PASSWORD = '';
    const DBNAME = 'demolay';
    public function __construct()
    {
        try {
            $this->conn = new \PDO(
                "mysql:dbname=" . Persistence::DBNAME . "; host=" . Persistence::HOSTNAME,
                Persistence::USERNAME,
                Persistence::PASSWORD
            );
            $this->conn->exec("set names utf8");
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    }
    public function runQuery(string $query, array $params)
    {
        $stmt = $this->conn->prepare($query);
        $this->setParams($stmt, $params);
        $res = $stmt->execute();
        return $res;
    }

    public function runExec(string $query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $results = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $results;
    }

    public function selectUniq(string $query, $id)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $results = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $results;
    }

    public function selectNoticias(string $query, $int1, $int2)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $int1, PDO::PARAM_INT);
        $stmt->bindParam(2, $int2, PDO::PARAM_INT);
        $confirm = $stmt->execute();
        if($confirm)
            $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        else
            $results = "Nenhum conteudo a ser exibido";
            
        return $results;
    }

    public function verificaLogin($query, $nomeUsuario){
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nomeUsuario);
        $stmt->execute();
        $results = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $results;
    }

    public function setParams($stmt, $params = array())
        {
        foreach ($params as $key => $value) {
            $this->bindParams($stmt, $key, $value);
        }
    }
    public function bindParams($stmt, $key, $value)
    {
        $stmt->bindParam($key, $value);
    }
}
