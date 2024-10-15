<?php 
class playM{
    private $conn;

    public $playID;
    public $eventID;
    public $gameID;
    public $userID;
    public $playTime;
    public $vourcherID;


    public function __construct($db){
        $this->conn = $db;        
    }

    //GetAll
    public function GetAll(){
        $sql = "SELECT * FROM play";
        $stmt = mysqli_query($this->conn, $sql);
        if(mysqli_num_rows($stmt) > 0){
            $arr = array();
            while ($row = $stmt->fetch_assoc()){
                extract($row);
                $user = new userM($this->conn);
                $user = $user->GetById($userID);
                $arr_item = array(
                    'playID'=>$playID,
                    'eventID'=>$eventID,
                    'gameID'=>$gameID,
                    'user'=>$user,
                    'playTime'=>$playTime,
                    'vourcherID'=>$vourcherID
                );
                $arr[] = $arr_item;
            }
            return $arr;
        }
    }
    //GetById
    public function GetById(int $id){
        $sql = "SELECT * FROM play WHERE play.playID =".$id." LIMIT 1";
        $stmt = mysqli_query($this->conn, $sql);
        if(mysqli_num_rows($stmt) > 0){
            $row = $stmt->fetch_assoc();

            $user = new userM($this->conn);
            $user = $user->GetById($row['userID']);
            $result = array(
                'playID'=>$row['playID'],
                'eventID'=>$row['eventID'],
                'gameID'=>$row['gameID'],
                'user'=>$user,
                'playTime'=>$row['playTime'],
                'vourcherID'=>$row['vourcherID']
            );
            return $result;
        }else{
            return false;
        }
    }
    //GetByUser
    public function GetByUser(int $id){
        $sql = "SELECT * FROM play WHERE play.userID =".$id;
        $stmt = mysqli_query($this->conn, $sql);
        if(mysqli_num_rows($stmt) > 0){
            $arr = array();
            while ($row = $stmt->fetch_assoc()){
                extract($row);
                $arr_item = array(
                    'playID'=>$playID,
                    'eventID'=>$eventID,
                    'gameID'=>$gameID,
                    'playTime'=>$playTime,
                    'vourcherID'=>$vourcherID
                );
                $arr[] = $arr_item;
            }
            return $arr;
        }else{
            $arr = [];
        }
        return $arr;
    }
    //GetByGameEvent
    public function GetByGameEvent(int $gameID, int $eventID){
        $sql = "SELECT * FROM play WHERE play.gameID = ".$gameID." AND play.eventID = ".$eventID;
        $stmt = mysqli_query($this->conn, $sql);
        if(mysqli_num_rows($stmt) > 0){
            $arr = array();
            while ($row = $stmt->fetch_assoc()){
                extract($row);
                $user = new userM($this->conn);
                $user = $user->GetById($userID);
                $arr_item = array(
                    'playID'=>$playID,
                    'eventID'=>$eventID,
                    'gameID'=>$gameID,
                    'user'=>$user,
                    'playTime'=>$playTime,
                    'vourcherID'=>$vourcherID
                );
                $arr[] = $arr_item;
            }
            return $arr;
        }
    }
    //Post
    public function Post(){
        $eventID = htmlspecialchars(strip_tags($this->eventID));
        $gameID =  htmlspecialchars(strip_tags($this->gameID));
        $userID =  htmlspecialchars(strip_tags($this->userID));
        $vourcherID = htmlspecialchars(strip_tags($this->vourcherID));
        
        $sql = "INSERT INTO play (eventID, gameID, userID, vourcherID) VALUES ( ?,?,?,?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiii", $eventID, $gameID, $userID, $vourcherID);
        $stmt->execute();
        $this->conn->close();
        return true;
    }

    //Put
    public function Put(int $id){
        $eventID = htmlspecialchars(strip_tags($this->eventID));
        $gameID =  htmlspecialchars(strip_tags($this->gameID));
        $userID =  htmlspecialchars(strip_tags($this->userID));
        $vourcherID = htmlspecialchars(strip_tags($this->vourcherID));
        
        $sql = "UPDATE play SET eventID =?, gameID=?, userID=?, vourcherID=? WHERE play.playID =" .$id;

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiii", $eventID, $gameID, $userID, $vourcherID);
        $stmt->execute();
        $this->conn->close();
        return true;
    }

    //Delete
    public function Delete(int $id){
        
        $sql = "DELETE FROM play WHERE play.playID =".$id;

        $stmt = mysqli_query($this->conn, $sql);
        return true;
    }
}
?>