<?php
// Force type hinting
declare(strict_types=1);


//Import de Model
require_once 'Model.php';


class Reservation extends Model
{
    protected string $table= 'reservation';
    
    public function add(array $params): void{
        try{
            $add=$this->dataBase->prepare(
                "INSERT INTO reservation(number, date,time, user_id) 
                VALUES (:number, :date, :time, :user_id)");
            $add->execute($params);
        }catch (PDOException $e) {
            echo $e->getMessage();
            exit;
    }
    }
    
      public function getREVsByUserId(int $id) {
            try {
                  $request = $this->dataBase->prepare(
                        "SELECT reservation.id as rev_id, reservation.number, reservation.date
                        FROM {$this->table}
                        INNER JOIN user ON reservation.user_id = user.id
                        WHERE user.id = :id"
                  );
                  $request->execute(
                        [
                              ':id' => intval($id)
                        ]
                  );
                  $result = $request->fetchAll();
            } catch (PDOException $e) {
                  echo $e->getMessage();
                  die;
            }
            return $result;
      }
}