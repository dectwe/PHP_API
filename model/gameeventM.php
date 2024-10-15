<?php 
class gameeventM{
    private $conn;
    
    public $gameID;
    public $eventID;

    public function __construct($db){
        $this->conn = $db;        
    }

    //GetByGameId
    public function GetByGameId(int $id){
        $sql = "SELECT  event.*  FROM gameevent JOIN event ON gameevent.eventID = event.eventID WHERE gameevent.gameID =".$id;
        $stmt = mysqli_query($this->conn, $sql);
        if(mysqli_num_rows($stmt) > 0){
            $arr = array();
            while ($row = $stmt->fetch_assoc()){
                extract($row);
                $user = new userM($this->conn);
                $user = $user->GetById($userID);
                
                $arr_item = array(
                    'eventID' => $eventID,
                    'eventName' => $eventName,
                    'releaseDate' => $releaseDate,
                    'endDate' => $endDate,
                    'eventUserId' => $user
                );
                $arr[] = $arr_item;
            }
        }else{
            $arr = [];
        }
        return $arr;
    }
    //GetByEventId
    public function GetByEventId(int $id){
        $sql = $sql = "SELECT  game.*  FROM gameevent JOIN game ON gameevent.gameID = game.gameID WHERE gameevent.eventID =".$id;
        $stmt = mysqli_query($this->conn, $sql);
        if(mysqli_num_rows($stmt) > 0){
            $arr = array();
            if(mysqli_num_rows($stmt) > 0){
                $arr = [];
                while ($row = $stmt->fetch_assoc()){
                    extract($row);
                    $arr_item = array(
                        'gameID' => $gameID,
                        'gameName' => $gameName,
                        'gameLink' =>$gameLink
                    );
                    $arr[]=$arr_item;
                }
            }else{
                $arr = [];
            }
            return $arr;
        }
    }
    //Post
    public function Post(){
        $gameID = htmlspecialchars(strip_tags($this->gameID));
        $eventID =  htmlspecialchars(strip_tags($this->eventID));
        
        $sql = "INSERT INTO gameevent (gameID, eventID) VALUES ( ?,?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $gameID, $eventID);
        $stmt->execute();
        $this->conn->close();
        return true;
    }
    
    //Put
    public function Put(int $gID, int $eID){
        $gameID = htmlspecialchars(strip_tags($this->gameID));
        $eventID = htmlspecialchars(strip_tags($this->eventID));
        $sql = "UPDATE gameevent SET  gameID =?, eventID=? WHERE gameevent.gameID = ".$gID." AND gameevent.eventID = ".$eID;

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $gameID, $eventID);
        $stmt->execute();
        $this->conn->close();
        return true;
    }
    //Delete
    public function Delete(int $gID, int $eID){
        
        $sql = "DELETE FROM gameevent WHERE gameevent.gameID = ".$gID." AND gameevent.eventID = ".$eID;

        $stmt = mysqli_query($this->conn, $sql);
        return true;
    }
    
}

?>