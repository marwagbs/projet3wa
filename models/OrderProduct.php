<?php
// Force type hinting
declare(strict_types=1);


//Import de Model
require_once 'Model.php';


class OrderProduct extends Model
{
    protected string $table= 'order_product';
    
    public function add(array $params): void{
        try{
            $add=$this->dataBase->prepare(
                "INSERT INTO order_product(quantity, order_id, product_id, price ) 
                VALUES (:quantity, :order_id, :product_id, :price)");
            $add->execute($params);
        }catch (PDOException $e) {
            echo $e->getMessage();
            exit;
    }
    }
}