<?php
// Force type hinting
declare(strict_types=1);


//Import de Model
require_once 'Model.php';


class Order extends Model
{
    protected string $table= 'order_detail';
    
    public function add(array $params){
        try{
            $add=$this->dataBase->prepare(
                "INSERT INTO order_detail(date, tva, total, user_id ) 
                VALUES (now(),:tva, :total, :user_id)");
            $add->execute($params);
            //pour récupérer le dernier id inserer en bdd
            return $this->dataBase->lastInsertId();
            
        }catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
    
}