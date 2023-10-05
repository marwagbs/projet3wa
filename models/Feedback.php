<?php
// Force type hinting
declare(strict_types=1);


//Import de Model
require_once 'Model.php';


class Feedback extends Model
{
    protected string $table= 'feedback';
    
    public function add(array $params){
        try{
            $add=$this->dataBase->prepare(
                "INSERT INTO feedback(comment, user_id ) 
                 VALUES (:comment, :user_id)");
            $add->execute($params);
            //pour récupérer le dernier id inserer en bdd
            return $this->dataBase->lastInsertId();
            
        }catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
    
}