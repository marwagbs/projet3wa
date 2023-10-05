<?php
// Force type hinting
declare(strict_types=1);


//Import de Model
require_once 'Model.php';


class Category extends Model
{
     protected string $table ='product_category';
     
       public function add(array $params): void{
        try{
            if($this->findByCategory($params[':name'])){
                throw new PDOException("cette category existe déja");
            }else
            $add=$this->dataBase->prepare(
                "INSERT INTO product_category (name, description) 
                VALUES (:name, :description)");
            $add->execute($params);
        }catch (PDOException $e) {
            echo $e->getMessage();
            exit;
    }
    }    
    
    public function findByCategory(string $name){
        try{
            $find=$this->dataBase->prepare("SELECT * FROM product_category WHERE name = :name");
            $find->execute([':name' => $name]);
            $category=$find->fetch();
        }catch (PDOException $e) {
            echo $e->getMessage();
            exit;
    }
    return $category;
    }
}