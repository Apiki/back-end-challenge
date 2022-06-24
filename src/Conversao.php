<?php

class Conversao{
    private $id;
    private $amount;
    private $from_coin;
    private $to_coin;
    private $rate;
    private $resultado;

    public function connection(){
        return new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

    }

    public function setId(int $id):void{
        $this->id = $id;
    }
    public function getId() :int{
        return $this->id;
    }
    
    public function setAmount(int $amount):void{
        $this->amount = $amount;
    }
    public function getAmount() :int{
        return $this->amount;
    }

    public function setfrom_coin(string $from_coin):void{
        $this->from_coin = $from_coin;
    }
    public function getfrom_coin() :string{
        return $this->from_coin;
    }

    public function setto_coin(string $to_coin):void{
        $this->to_coin = $to_coin;
    }
    public function getto_coin() :string{
        return $this->to_coin;
    }

    public function setrate(int $rate):void{
        $this->rate = $rate;
    }
    public function getrate() :int{
        return $this->rate;
    }

    public function setResultado(float $resultado):void{
        $this->resultado = $resultado;
    }
    public function getResultado() :float{
        return $this->resultado;
    }



    public function exchange(){
        $con = $this->connection();
        $stmt = $con->prepare("INSERT INTO conversoes(amount,from_coin,
                to_coin,rate,resultado) VALUES (:_amount,:_from,:_to,:_rate,:_resultado)");
        $stmt->bindValue(":_amount",$this->getAmount());
        $stmt->bindValue(":_from",$this->getfrom_coin());
        $stmt->bindValue(":_to",$this->getto_coin());
        $stmt->bindValue(":_rate",$this->getrate());
        $stmt->bindValue(":_resultado",$this->getResultado());
        if($stmt->execute()){
            $this->setId($con->lastInsertId());
            return $this->read();
        }
        return [];
    }
    
    public function read(){
        $con = $this->connection();
            
        $stmt = $con->prepare("SELECT * FROM conversoes where id=:_id");
        $stmt->bindValue(":_id", $this->getId());
        if($stmt->execute()){
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            
    }
}}

