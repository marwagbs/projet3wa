<?php
// Force type hinting
declare(strict_types=1);


//Import de Model
require_once 'Model.php';

class User extends Model
{
    protected string $table ='user';
    
    public function add(array $params): void{
        try{
            
                //insertion de l'utilisateur
          
                $add = $this->dataBase->prepare(
                   "INSERT INTO user ( mail, password, first_name, last_name, phone_number, is_news) VALUES (:email, :password, :firstName, :lastName, :phoneNumber, :isNews)"
                );
                $add->execute($params);
        }catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
    //chercher l'utilisateur par son mail
    public function findByEmail(string $email){
        try{
            $find= $this->dataBase->prepare("SELECT * FROM user WHERE mail = :email");
            $find->execute([':email' => $email]);
            $res=$find->fetch();
        }catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
        // var_dump($res);
        // die;
        return $res;
    }
    
    
     public function updateToken($email, $token){
        try{
        $stmt = $this->dataBase->prepare(" UPDATE user SET token = :token WHERE mail=:email");
        $stmt->execute([':token' => $token,':email' => $email]) ;
       
       
    }catch (PDOException $e) {
        echo $e->getMessage();
        die;
    }
          
    
    }
     
    //modification du password
    public function updatePassword($password, $email){
        try{
        $stmt = $this->dataBase->prepare("UPDATE user SET password =:password, token = NULL WHERE mail=:email");
        $stmt->execute([':password' => $password,':email' => $email]) ;
       
       
    }catch (PDOException $e) {
        echo $e->getMessage();
        die;
    }
    }
    
    public function getFeedback(){
        try{
            $find=$this->dataBase->prepare(" SELECT first_name, last_name, comment FROM user INNER JOIN feedback ON user.id=feedback.user_id");
            $find->execute();
            $request = $find->fetchAll();
            
        }catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        // var_dump($request);
        // die;
         return $request;
        
    }


    
}

