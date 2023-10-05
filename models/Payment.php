<?php
// Force type hinting
declare(strict_types=1);


//Import de Model
require_once 'Model.php';


class Payment extends Model
{
    protected string $table= 'payment_detail';
    
    public function add(array $params){
        try{
            $add=$this->dataBase->prepare(
                "INSERT INTO payment_detail (amount, status, order_detail_id, user_id ) 
                VALUES (:amount,:status, :order_detail_id, :user_id)");
            $add->execute($params);

            
        }catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
}