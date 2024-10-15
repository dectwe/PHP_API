<?php 
    class eventM{
        private $conn;
        
        public $eventID;
        public $eventName;
        public $releaseDate;
        public $endDate;
        public $userID;

        public function __construct($db){
            $this->conn = $db;        
        }


    //GetAll
        public function GetAll(){
            $sql = "SELECT * FROM `event`";
            $stmt = mysqli_query($this->conn, $sql);
            if(mysqli_num_rows($stmt) > 0){
                $arr = Array();
                while ($row = $stmt->fetch_assoc()){
                    extract($row);
                    $user = new userM($this->conn);
                    $user = $user->GetById($userID);
                    $game = new gameeventM($this->conn);
                    $game = $game->GetByEventId($eventID);
                    $arr_item = array(
                        'eventID' => $eventID,
                        'eventName' => $eventName,
                        'releaseDate' => $releaseDate,
                        'endDate' => $endDate,
                        'user' => $user,
                        'game' => $game
                    );
                    $arr[] = $arr_item;
                }
                return $arr;
            }
        }

    //GetById
    public function GetById(int $id){
        $sql = "SELECT * FROM `event` WHERE event.eventID =".$id." LIMIT 1";
        $stmt = mysqli_query($this->conn, $sql);
        if(mysqli_num_rows($stmt) > 0){
            $row = $stmt->fetch_assoc();

            $user = new userM($this->conn);
            $user = $user->GetById($row['userID']);
            $game = new gameeventM($this->conn);
            $game = $game->GetByEventId($row['eventID']);
            $result = array(
                'eventID' => $row['eventID'],
                'eventName' => $row['eventName'],
                'releaseDate' => $row['releaseDate'],
                'endDate' => $row['endDate'],
                'user' => $user,
                'game' => $game
            );
            return $result;
        }else{
            return false;
        }
    }

    //GetByOwner
    public function GetByOwner(int $id){
        $sql = "SELECT * FROM event WHERE event.userID =".$id;
        $stmt = mysqli_query($this->conn, $sql);
        if(mysqli_num_rows($stmt) > 0){
            $arr = Array();
            while ($row = $stmt->fetch_assoc()){
                extract($row);
                $user = new userM($this->conn);
                $user = $user->GetById($userID);
                $game = new gameeventM($this->conn);
                $game = $game->GetByEventId($eventID);
                $arr_item = array(
                    'eventID' => $eventID,
                    'eventName' => $eventName,
                    'releaseDate' => $releaseDate,
                    'endDate' => $endDate,
                    'user' => $user,
                    'game' => $game
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
        $eventName = htmlspecialchars(strip_tags($this->eventName));
        $releaseDate =  htmlspecialchars(strip_tags($this->releaseDate));
        $endDate =  htmlspecialchars(strip_tags($this->endDate));
        $userID = htmlspecialchars(strip_tags($this->userID));
        $sql = "INSERT INTO event (eventName, releaseDate,endDate,userID) VALUES ( ?,?,?,?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi", $eventName, $releaseDate,$endDate,$userID);
        $stmt->execute();
        $this->conn->close();
        return true;
    }

    //Put
    public function Put(int $id){
        $eventName = htmlspecialchars(strip_tags($this->eventName));
        $releaseDate =  htmlspecialchars(strip_tags($this->releaseDate));
        $endDate =  htmlspecialchars(strip_tags($this->endDate));
        $userID = htmlspecialchars(strip_tags($this->userID));
        $sql = "UPDATE event SET eventName =?, releaseDate =?, endDate=?, userID=? WHERE event.eventID = ".$id;

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi", $eventName, $releaseDate,$endDate,$userID);
        $stmt->execute();
        $this->conn->close();
        return true;
    }

    //Delete
    public function Delete(int $id){
        
        $sql = "DELETE FROM event WHERE event.eventID =".$id;

        $stmt = mysqli_query($this->conn, $sql);
        return true;
    }

}
?>