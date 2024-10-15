<?php 
class userM{
    private $conn;
    
    public $userID;
    public $userName;
    public $password;
    public $typeID;
    public $userType;
    public $store;

    public function __construct($db){
        $this->conn = $db;        
    }

    //GetAll
    public function GetAll(){
        $sql = "SELECT * FROM user";
        $stmt = mysqli_query($this->conn, $sql);
        if(mysqli_num_rows($stmt) > 0){
            $arr = Array();
            while ($row = $stmt->fetch_assoc()){
                extract($row);
                $userType = new usertypeM($this->conn);
                $type = $userType->GetById($typeID);
                $store = new storeM($this->conn);
                $arrStore = $store->GetByOwner($userID);
                $arr_item = array(
                    'userID' => $userID,
                    'userName' => $userName,
                    'userPassword' => $userPassword,
                    'userType' => $type,
                    'store' => $arrStore
                );
                $arr[] = $arr_item;
            }
            return $arr;
        }
    }
    //GetById
    public function GetById(int $id){
        $sql = "SELECT * FROM user as u WHERE u.userID =".$id." LIMIT 1";
        $stmt = mysqli_query($this->conn, $sql);
        if(mysqli_num_rows($stmt) > 0){
            $row = $stmt->fetch_assoc();
            $userType = new usertypeM($this->conn);
            $arrType = $userType->GetById($row['typeID']);
            $store = new storeM($this->conn);
            $arrStore = $store->GetByOwner($row['userID']);
            $result = array(
                'userID' => $row['userID'],
                'userName' => $row['userName'],
                'password' => $row['userPassword'],
                'userType' => $arrType,
                'store' => $arrStore
            );
            return $result;
        }else{
            return false;
        }
    }
    //GetByTypeId
    public function GetByTypeId(int $id){
        $sql = "SELECT * FROM user as u WHERE u.typeID =".$id;
        $stmt = mysqli_query($this->conn, $sql);
        if(mysqli_num_rows($stmt) > 0){
            $arr = Array();
            while ($row = $stmt->fetch_assoc()){
                extract($row);
                $userType = new usertypeM($this->conn);
                $type = $userType->GetById($typeID);
                $store = new storeM($this->conn);
                $arrStore = $store->GetByOwner($userID);
                $arr_item = array(
                    'userID' => $userID,
                    'userName' => $userName,
                    'userPassword' => $userPassword,
                    'userType' => $type,
                    'store' => $arrStore
                );
                $arr[] = $arr_item;
            }
            return $arr;
        }
    }
    //GetByUserName
    public function GetByUserName(string $username){
        $sql = "SELECT * FROM user as u WHERE u.userName ='".$username."' LIMIT 1";
        $stmt = mysqli_query($this->conn, $sql);
        if(mysqli_num_rows($stmt) > 0){
            $row = $stmt->fetch_assoc();
            $userType = new usertypeM($this->conn);
            $arrType = $userType->GetById($row['typeID']);
            $store = new storeM($this->conn);
            $arrStore = $store->GetByOwner($row['userID']);
            $result = array(
                'userID' => $row['userID'],
                'userName' => $row['userName'],
                'userPassword' => $row['userPassword'],
                'userType' => $arrType,
                'store' => $arrStore
            );
            return $result;
        }else{
            return false;
        }
    }

    //Post
    public function Post(){
        $userName = htmlspecialchars(strip_tags($this->userName));
        $userPassword =  htmlspecialchars(strip_tags($this->userPassword));
        $typeID =  htmlspecialchars(strip_tags($this->typeID));
        $sql = "INSERT INTO user (userName, userPassword, typeID) VALUES ( ?,?,?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssi", $userName, $userPassword,$typeID);
        $stmt->execute();
        $this->conn->close();
        return true;
    }
    
    //Put
    public function Put(int $id){
        $userName = htmlspecialchars(strip_tags($this->userName));
        $userPassword =  htmlspecialchars(strip_tags($this->userPassword));
        $typeID =  htmlspecialchars(strip_tags($this->typeID));
        $sql = "UPDATE user SET userName =?, userPassword =?, typeID=? WHERE user.userID = ".$id;

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssi", $userName, $userPassword, $typeID);
        $stmt->execute();
        $this->conn->close();
        return true;
    }

    //Delete
    public function Delete(int $id){
        
        $sql = "DELETE FROM user WHERE user.userID =".$id;

        $stmt = mysqli_query($this->conn, $sql);
        return true;
    }
}
?>