<?php

class bdd{
    private $host;
    private $username;
    private $password;
    private $database;
    private $pdo;

    public function __construct($host, $username, $password, $database) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    public function connect() {
        try {
            $this->pdo = new PDO('mysql:host='.$this->host.';dbname='.$this->database, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function query($req) {
        try {
            $stmt = $this->pdo->prepare($req);
            
        
            $stmt->execute();
        
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
        return $stmt;
    }


    public function close() {
        $pdo = null;
    }
  
}