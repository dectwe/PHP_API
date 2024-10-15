<?php 
class userTypeM{
    private $conn;
    
    public $typeID;
    public $typeName;

    public function __construct($db){
        $this->conn = $db;        
    }

    //GetAll
    public function GetAll(){
        $sql = "SELECT * FROM usertype";
        $stmt = mysqli_query($this->conn, $sql);
        if(mysqli_num_rows($stmt) > 0){
            $arr = [];
            while ($row = $stmt->fetch_assoc()){
                extract($row);
                $arr_item = array(
                    'typeID' => $typeID,
                    'typeName' => $typeName,
                );
                $arr[]=$arr_item;
            }
            return $arr;
        }
    }

    //GetById
    public function GetbyId(int $id){
        $sql = "SELECT * FROM usertype as t WHERE t.typeID =".$id." LIMIT 1";
        $stmt = mysqli_query($this->conn, $sql);
        if(mysqli_num_rows($stmt) > 0){
            $row = $stmt->fetch_assoc();
            $result = array(
                'typeID' => $row['typeID'],
                'typeName' => $row['typeName'],
            );
            return $result;
        }else{
            return false;
        }
    }

    //Post
    //Put
    //Delete
}

?>