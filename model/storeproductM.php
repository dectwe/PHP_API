<?php 
class storeproductM{
    private $conn;
    
    public $storeID;
    public $productID;
    public $remaining;

    public function __construct($db){
        $this->conn = $db;        
    }

    //GetByStoreId
    public function GetByStoreId(int $id){
        $sql = "SELECT  product.productID, product.productName, product.productPrice,storeproduct.remaining  FROM storeproduct JOIN product ON storeproduct.productID = product.productID WHERE storeproduct.storeID =".$id;
        $stmt = mysqli_query($this->conn, $sql);
        if(mysqli_num_rows($stmt) > 0){
            $arr = array();
            while($row = $stmt->fetch_assoc()){
                extract($row);
                $arr_item = array(
                    'productID'=>$productID,
                    'productName'=> $productName,
                    'productPrice'=>$productPrice,
                    'remaining'=>$remaining,
                );
                $arr[] =$arr_item;
            }
        }else{
            $arr = [];
        }
        return $arr;
    }
    //GetByProductId
    public function GetByProductId(int $id){
        $sql = "SELECT  store.*, storeproduct.remaining  FROM store JOIN storeproduct ON store.storeID = storeproduct.storeID WHERE storeproduct.productID =".$id;
        $stmt = mysqli_query($this->conn, $sql);
        if(mysqli_num_rows($stmt) > 0){
            $arr = array();
            while($row = $stmt->fetch_assoc()){
                extract($row);
                $arr_item = array(
                    'storeID'=>$storeID,
                    'storeName'=> $storeName,
                    'storeAddress'=>$storeAddress,
                    'ownerID' => $ownerID,
                    'remaining'=>$remaining
                );
                $arr[]= $arr_item;
            }
        }else{
            $arr = [];
        }
        return $arr;
    }

    //Post
    public function Post(){
        $storeID = htmlspecialchars(strip_tags($this->storeID));
        $productID =  htmlspecialchars(strip_tags($this->productID));
        $remaining =  htmlspecialchars(strip_tags($this->remaining));
        $sql = "INSERT INTO storeproduct (storeID, productID,remaining) VALUES ( ?,?,?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iii", $storeID, $productID,$remaining);
        $stmt->execute();
        $this->conn->close();
        return true;
    }

    //Put
    public function Put(int $sid ,int $pid){
        $storeID = htmlspecialchars(strip_tags($this->storeID));
        $productID =  htmlspecialchars(strip_tags($this->productID));
        $remaining =  htmlspecialchars(strip_tags($this->remaining));
        $sql = "UPDATE storeproduct SET storeID =?, productID =?, remaining=? WHERE storeproduct.storeID = ".$sid." AND storeproduct.productID = ".$pid;

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iii", $storeID, $productID,$remaining);
        $stmt->execute();
        $this->conn->close();
        return true;
    }

    //Delete
    public function Delete(int $sid ,int $pid){
        
        $sql = "DELETE FROM storeproduct WHERE storeproduct.storeID = ".$sid." AND storeproduct.productID = ".$pid;

        $stmt = mysqli_query($this->conn, $sql);
        return true;
    }
}
?>