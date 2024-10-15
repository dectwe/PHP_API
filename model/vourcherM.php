<?php 
class vourcherM{
    private $conn;

    public $vourcherID;
    public $vourcherName;
    public $vourcherValue;
    public $eventID;
    public $expirationDate;
    public $vourcherStatus;
    public $ownerID;

    public function __construct($db){
        $this->conn = $db;        
    }

    //GetAll
    public function GetAll(){
        $sql = "SELECT * FROM vourcher";
        $stmt = mysqli_query($this->conn, $sql);
        if(mysqli_num_rows($stmt) > 0){
            $arr = array();
            while ($row = $stmt->fetch_assoc()){
                extract($row);
                $event = new eventM($this->conn);
                $event = $event->GetById($eventID);
                $arr_item = array(
                    'vourcherID' => $vourcherID,
                    'vourcherName'=>$vourcherName,
                    'expirationDate' => $expirationDate,
                    'vourcherStatus' => $vourcherStatus,
                    'ownerID' => $ownerID,
                    'event' => $event
                );
                $arr[] = $arr_item;
            }
            return $arr;
        }
    }

    //GetById
    public function GetbyId(int $id){
        $sql = "SELECT * FROM vourcher WHERE vourcher.vourcherID =".$id." LIMIT 1";
        $stmt = mysqli_query($this->conn, $sql);
        if(mysqli_num_rows($stmt) > 0){
            $row = $stmt->fetch_assoc();
            $event = new eventM($this->conn);
            $event = $event->GetById($row["eventID"]);
            $result = array(
                'vourcherID' => $row["vourcherID"],
                'vourcherName'=>$row["vourcherName"],
                'expirationDate' => $row["expirationDate"],
                'vourcherStatus' => $row["vourcherStatus"],
                'ownerID' => $row["ownerID"],
                'event' => $event
            );
            return $result;
        }else{
            return false;
        }
    }

    //GetByEvent
    public function GetByEvent(int $id){
        $sql = "SELECT * FROM vourcher WHERE vourcher.eventID =".$id;
        $stmt = mysqli_query($this->conn, $sql);
        if(mysqli_num_rows($stmt) > 0){
            $arr = array();
            while ($row = $stmt->fetch_assoc()){
                extract($row);
                $event = new eventM($this->conn);
                $event = $event->GetById($eventID);
                $arr_item = array(
                    'vourcherID' => $vourcherID,
                    'vourcherName'=>$vourcherName,
                    'expirationDate' => $expirationDate,
                    'vourcherStatus' => $vourcherStatus,
                    'ownerID' => $ownerID,
                    'event' => $event
                );
                $arr[] = $arr_item;
            }
        }else{
            $arr = [];
        }
        return $arr;
    }

    //GetByOwner
    public function GetByOwner(int $id){
        $sql = "SELECT * FROM vourcher WHERE vourcher.OwnerID =".$id;
        $stmt = mysqli_query($this->conn, $sql);
        if(mysqli_num_rows($stmt) > 0){
            $arr = array();
            while ($row = $stmt->fetch_assoc()){
                extract($row);
                $event = new eventM($this->conn);
                $event = $event->GetById($eventID);
                $arr_item = array(
                    'vourcherID' => $vourcherID,
                    'vourcherName'=>$vourcherName,
                    'expirationDate' => $expirationDate,
                    'vourcherStatus' => $vourcherStatus,
                    'ownerID' => $ownerID,
                    'event' => $event
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
        $vourcherName = htmlspecialchars(strip_tags($this->vourcherName));
        $vourcherValue =  htmlspecialchars(strip_tags($this->vourcherValue));
        $eventID =  htmlspecialchars(strip_tags($this->eventID));
        $expirationDate = htmlspecialchars(strip_tags($this->expirationDate));
        $vourcherStatus =  htmlspecialchars(strip_tags($this->vourcherStatus));
        $ownerID = htmlspecialchars(strip_tags($this->ownerID));
        $sql = "INSERT INTO vourcher (vourcherName, vourcherValue,expirationDate,eventID,vourcherStatus,ownerID) VALUES ( ?,?,?,?,?,?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sisiii", $vourcherName, $vourcherValue, $expirationDate, $eventID, $vourcherStatus, $ownerID);
        $stmt->execute();
        $this->conn->close();
        return true;
    }

    //Put
    public function Put(int $id){
        $vourcherName = htmlspecialchars(strip_tags($this->vourcherName));
        $vourcherValue =  htmlspecialchars(strip_tags($this->vourcherValue));
        $eventID =  htmlspecialchars(strip_tags($this->eventID));
        $expirationDate = htmlspecialchars(strip_tags($this->expirationDate));
        $vourcherStatus =  htmlspecialchars(strip_tags($this->vourcherStatus));
        $ownerID = htmlspecialchars(strip_tags($this->ownerID));
        $sql = "UPDATE vourcher SET vourcherName =?, vourcherValue =?, expirationDate=?, eventID=?, vourcherStatus=?, ownerID=? WHERE vourcher.vourcherID = ".$id;

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sisiii", $vourcherName, $vourcherValue, $expirationDate, $eventID, $vourcherStatus, $ownerID);
        $stmt->execute();
        $this->conn->close();
        return true;
    }

    //Delete
    public function Delete(int $id){
        
        $sql = "DELETE FROM vourcher WHERE vourcher.vourcherID = ".$id;

        $stmt = mysqli_query($this->conn, $sql);
        return true;
    }
}
?>