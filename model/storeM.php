<?php 
class storeM{
    private $conn;
    
    public $storeID;
    public $storeName;
    public $storeAddress;
    public $ownerID;
    public $storeproduct;

    public function __construct($db){
        $this->conn = $db;        
    }

    //GetAll
    public function GetAll(){
        $sql = "SELECT * FROM store";
        $stmt = mysqli_query($this->conn, $sql);
        if(mysqli_num_rows($stmt) > 0){
            $arr = array();
            while ($row = $stmt->fetch_assoc()){
                extract($row);
                $storeproduct = new storeproductM($this->conn);
                $product = $storeproduct->GetByStoreId($storeID);
                $arr_item = array(
                    'storeID' => $storeID,
                    'storeName' => $storeName,
                    'storeAddress'=>$storeAddress,
                    'ownerID' => $ownerID,
                    'product' => $product
                );
                $arr[] = $arr_item;
            }
            return $arr;
        }
    }

    //GetById    
    public function GetbyId(int $id){
        $sql = "SELECT * FROM store as s WHERE s.storeID =".$id." LIMIT 1";
        $stmt = mysqli_query($this->conn, $sql);
        if(mysqli_num_rows($stmt) > 0){
            $row = $stmt->fetch_assoc();
            $storeproduct = new storeproductM($this->conn);
            $product = $storeproduct->GetByStoreId( $row['storeID']);
            $result = array(
                'storeID' => $row['storeID'],
                'storeName' => $row['storeName'],
                'storeAddress' => $row['storeAddress'],
                'ownerID' => $row['ownerID'],
                'product' => $product
            );
            return $result;
        }else{
            return false;
        }
    }

    //GetByOwner
    public function GetByOwner(int $id){
        $sql = "SELECT * FROM store as s WHERE s.OwnerID =".$id;
        $stmt = mysqli_query($this->conn, $sql);
        if(mysqli_num_rows($stmt) > 0){
            $arr = array();
            while ($row = $stmt->fetch_assoc()){
                extract($row);
                $storeproduct = new storeproductM($this->conn);
                $product = $storeproduct->GetByStoreId($storeID);
                $arr_item = array(
                    'storeID' => $storeID,
                    'storeName' => $storeName,
                    'storeAddress'=>$storeAddress,
                    'ownerID' => $ownerID,
                    'product' => $product
                );
                $arr[] = $arr_item;
            }
        }else{
            $arr = [];
        }
        return $arr;
    }

    //Post
    public function Post(){
        $storeName = htmlspecialchars(strip_tags($this->storeName));
        $storeAddress =  htmlspecialchars(strip_tags($this->storeAddress));
        $ownerID =  htmlspecialchars(strip_tags($this->ownerID));
        $sql = "INSERT INTO store (storeName, storeAddress,ownerID) VALUES ( ?,?,?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssi", $storeName, $storeAddress,$ownerID);
        $stmt->execute();
        $this->conn->close();
        return true;
    }

    //Put
    public function Put(int $id){
        $storeName = htmlspecialchars(strip_tags($this->storeName));
        $storeAddress =  htmlspecialchars(strip_tags($this->storeAddress));
        $ownerID =  htmlspecialchars(strip_tags($this->ownerID));
        $sql = "UPDATE store SET storeName =?, storeAddress =?, ownerID=? WHERE store.storeID = ".$id;

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssi", $storeName, $storeAddress,$ownerID);
        $stmt->execute();
        $this->conn->close();
        return true;
    }

    //Delete
    public function Delete(int $id){
        
        $sql = "DELETE FROM store WHERE store.storeID =".$id;

        $stmt = mysqli_query($this->conn, $sql);
        return true;
    }
}
?>