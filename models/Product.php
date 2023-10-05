<?php
// Force type hinting
declare(strict_types=1);


//Import de Model
require_once 'Model.php';


class Product extends Model
{
    protected string $table= 'product';
    
    public function add(array $params): void{
        try{
            if($this->findByName($params[':name'])){
                throw new PDOException("ce produit existe déja");
            }else
            $add=$this->dataBase->prepare(
                "INSERT INTO product(name, description, price, picture, product_category_id) 
                VALUES (:name, :description, :price, :picture, :category)");
            $add->execute($params);
        }catch (PDOException $e) {
            echo $e->getMessage();
            exit;
    }
    }    
    
    public function findByName(string $name){
        try{
            $find=$this->dataBase->prepare("SELECT * FROM product WHERE name = :name");
            $find->execute([':name' => $name]);
            $res=$find->fetch();
        }catch (PDOException $e) {
            echo $e->getMessage();
            exit;
    }
    return $res;
    }
    
    
    public function uptadePrice(string $price, string $id){
        try{
            $up=$this->dataBase->prepare("UPDATE product SET price = :price WHERE id = :id");
            $up->execute([':price'=> $price, ':id' => $id]);
            $res=$up->fetchAll();
        }catch (PDOException $e) {
            echo $e->getMessage();
            exit;
    }
    return $res;
    }
    
    //function pour parcourir tout les id de localstorage
    public function localStorage(array $params){
        
          try{
        $sql="SELECT * FROM product WHERE";
        for($i=0, $c=count($params); $i<$c; $i++){
            if($i > 0){
                $sql .=' OR ';
            }
            $sql .=' id = ' . $params[$i];
         
        }
        $request=$this->dataBase->prepare($sql);
        $request->execute();
         $res=$request->fetchAll();
        }catch (PDOException $e) {
            echo $e->getMessage();
            exit;
    }
    return $res;

    }
    public function filterByOrder($min, $max, $filter = null): array
    {
         try{
             
             $find="SELECT * FROM product ";
             $find.='WHERE price BETWEEN  :min AND  :max ';
            if($filter!==null){
                 if($filter == 'price_desc') {
                     $find.= 'ORDER BY price DESC';
                 } elseif($filter == 'price_asc'){
                      $find.= 'ORDER BY price ASC';
                 } elseif($filter == 'name_desc') {
                    $find.='ORDER BY name DESC';
                }elseif($filter == 'name_asc') {
                    $find.='ORDER BY name ASC';
                }
            } else {
                $find.= 'ORDER BY id ASC';
            }
      
            $request=$this->dataBase->prepare($find);
             $request->execute([':min'=>$min, ':max'=>$max]);
            //$request->execute();
            $res=$request->fetchAll();
            
        }catch (PDOException $e) {
            echo $e->getMessage();
            exit;
    }
    return $res;
    }
    
     public function priceDESC(): ?array{
        try{
            $find=$this->dataBase->prepare("SELECT * FROM {$this->table} ORDER BY price DESC");
            $find->execute();
            $request=$find->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        return $request;
    }
      public function priceASC(): ?array{
        try{
            $find=$this->dataBase->prepare("SELECT * FROM {$this->table} ORDER BY price ASC");
            $find->execute();
            $request=$find->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        return $request;
    }
    
    
     public function searchProduct($search)
    {
        try{
            $find=$this->dataBase->prepare("SELECT * FROM {$this->table} WHERE name LIKE :search");
            $find->execute([':search'=>$search]);
            $request=$find->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        return $request;
    }
    
}