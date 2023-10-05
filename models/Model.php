<?php
declare (strict_types=1);


abstract class Model{
    protected PDO $dataBase;
    protected string $table;
    
    public function __construct(){
        //connexion à la BDD
        try{
            $this->dataBase= new PDO('mysql:host=db.3wa.io;dbname=marwaghedamssi_projet;charset=UTF8',
		'marwaghedamssi',
		'9df2df27a94d3e613fe34ef98318c316',
	    [
	    	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
	    ]);
        } catch(PDOException $e) {
            echo $e->getMessage();
    }
    }
    
     abstract public function add(array $params);
     
     //fonction qui renvoi un tableau permet de selectionner tous les champs de la table 
     public function findAll(): ?array{
         try{
             $find = $this->dataBase->query("SELECT * FROM {$this->table}");
             $request = $find->fetchAll();
         }catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        return $request ?? [];
     }

    //Retourne un enregistrement, trouvé par son id
    public function findById(int $id): ?array{
        try{
            $find=$this->dataBase->prepare("SELECT * FROM {$this->table} WHERE id =:id");
            $find->execute([':id' =>$id]);
            $request=$find->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        return $request;
    }
    
    //Suppression d'un Produit
    public function delete(string $id) :void{
        try{
            //suppression de l'id correspond à notre recherche
            $find=$this->dataBase->prepare(
                "DELETE FROM {$this->table} WHERE id= :id");
            $find->execute([':id' => $id]);
     
        }catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }
    
}