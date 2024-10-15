<?php 
class productM{
    private $conn;
    
    public $productID;
    public $productName;
    public $productPrice;

    public function __construct($db){
        $this->conn = $db;        
    }

    //GetAll
    public function GetAll(){
        $sql = "SELECT * FROM product";
        $stmt = mysqli_query($this->conn, $sql);
        if(mysqli_num_rows($stmt) > 0){
            $arr = array();
            while ($row = $stmt->fetch_assoc()){
                extract($row);
                $arr_item = array(
                    'productID' => $productID,
                    'productName' => $productName,
                    'productPrice' => $productPrice,
                );
                $arr[] = $arr_item;
            }
            return $arr;
        }
    }

    //GetById
    public function GetbyId(int $id){
        $sql = "SELECT * FROM product as p WHERE p.productID =".$id." LIMIT 1";
        $stmt = mysqli_query($this->conn, $sql);
        if(mysqli_num_rows($stmt) > 0){
            $row = $stmt->fetch_assoc();
            $result = array(
                'productID' => $row['productID'],
                'productName' => $row['productName'],
                'productPrice' => $row['productPrice']
            );
            return $result;
        }else{
            return false;
        }
    }

    //Post
    public function Post(){
        $productName = htmlspecialchars(strip_tags($this->productName));
        $productPrice =  htmlspecialchars(strip_tags($this->productPrice));
        $sql = "INSERT INTO product (productName, productPrice) VALUES ( ?,?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $productName, $productPrice);
        $stmt->execute();
        $this->conn->close();
        return true;
    }

    //Put
    public function Put(int $id){
        $productName = htmlspecialchars(strip_tags($this->productName));
        $productPrice =  htmlspecialchars(strip_tags($this->productPrice));
        $sql = "UPDATE product SET productName =?, productPrice =? WHERE product.productID = ".$id;

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $productName, $productPrice);
        $stmt->execute();
        $this->conn->close();
        return true;
    }

    //Delete
    public function Delete(int $id){
        
        $sql = "DELETE FROM product WHERE product.productID =".$id;

        $stmt = mysqli_query($this->conn, $sql);
        return true;
    }
}
?>