<?php

require_once '../classes' . DIRECTORY_SEPARATOR . 'DatabasePDO.php';

class VoorbeeldDAO
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = DatabasePDO::getInstance();
    }

    public function getAllPloegen(){
        $sql = "SELECT * 
                FROM ploegen WHERE betaald = 1 ORDER BY creation_date ASC";
        $stmt = $this->pdo->prepare($sql);
        if($stmt->execute()){
            $msg = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($msg)){
                return $msg;
            }
        }
        return array();
    }
    
    public function getPloegById($id){
        $sql = "SELECT * 
                FROM ploegen WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id",$id);
        if($stmt->execute()){
            $msg = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($msg)){
                return $msg;
            }
        }
        return array();
    }
    
    public function addPloeg($team_naam,$ver_naam,$ver_mail,$ver_gsm){
        $sql = "INSERT INTO ploegen (ploeg_naam,naam_verantwoordelijke,mail_verantwoordelijke,gsm_verantwoordelijke) VALUES (:team_naam,:ver_naam,:ver_mail,:ver_gsm)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":team_naam",$team_naam);
        $stmt->bindValue(":ver_naam",$ver_naam);
        $stmt->bindValue(":ver_mail",$ver_mail);
        $stmt->bindValue(":ver_gsm",$ver_gsm);
        if($stmt->execute()){
            return $this->getPloegById($this->pdo->lastInsertId());
        }
        return false;
    }

}